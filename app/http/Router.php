<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;

class Router {

    /**
     * URL das páginas
     * @var string
     */
    private $url = '';

    /**
     * Prefixo de todas as rotas
     * @var string
     */
    private $prefix = '';

    /**
     * Indice de todas as rotas
     * @var array
     */
    private $routes = [];

    /**
     * Instância de request
     * @var Request
     */
    private $request;

    /**
     * Método Construtor da Classe Router
     * @param string $url
     */
    public function __construct($url){
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    /**
     * Seta a variável prefix de forma dinâmica
     */
    private function setPrefix(){
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Método que adiciona uma rota na classe Router
     *
     * @param string $method
     * @param string $route
     * @param array $params
     */
    private function addRoute($method, $route, $params = []){
        //validação dos parâmetros
        foreach($params as $key => $value){
            if($value instanceof Closure){
               $params['controller'] = $value;
               unset($params[$key]);
            }
        }

        $params['variables'] = [];

        //REGEX para validação das variáveis vida na URI
        $patternVariable = '/{(.*?)}/';

        //procura variáveis nas rotas
        if(preg_match_all($patternVariable, $route, $matches)){
           $route = preg_replace($patternVariable, '(.*?)', $route);
           $params['variables'] = $matches[1];
        }

       
        

        //REGEX para padronizar URL
        $patternRoute ='/^'.str_replace('/', '\/', $route).'$/';
        
        //Adiciona rota no objeto
        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * Método responsavel por definir uma rota de GET
     * @param string $route
     * @param array $params
     */
    public function get($route, $params = []){
       $this->addRoute('GET', $route, $params);
    }
    
    /**
     * Método responsavel por definir uma rota de POST
     * @param string $route
     * @param array $params
     */
    public function post($route, $params = []){
       $this->addRoute('POST', $route, $params);
    }

    /**
     * Método responsavel por definir uma rota de PUT
     * @param string $route
     * @param array $params
     */
    public function put($route, $params = []){
       $this->addRoute('PUT', $route, $params);
    }
    /**
     * Método responsavel por definir uma rota de DELETE
     * @param string $route
     * @param array $params
     */
    public function delete($route, $params = []){
       $this->addRoute('DELETE', $route, $params);
    }

    /**
     * Método que executa a rota
     *
     * @return Response
     */
    public function run(){
        try{
             $route = $this->getRoute();

             if(!isset($route['controller'])){
                 throw new Exception("Problemas internos!", 500);
             }

             $args = [];

             //ReflectionFunction
             $reflection = new ReflectionFunction($route['controller']);
             foreach($reflection->getParameters() as $parameter){
                 $name = $parameter->getName();
                 $args[$name] = $route['variables'][$name] ?? "";
             }

             return call_user_func_array($route['controller'], $args);

        }catch(Exception $err){
            return new Response($err->getCode(), $err->getMessage());
        }
    }

    /**
     * Método que retorna a rota atual
     *
     * @return array
     */
    private function getRoute(){
        //URI sem prefixo
        $uri = $this->getUri();

        //Método HTTP da rota
        $httpMethod = $this->request->getHttpMethod();

        foreach($this->routes as $patternRoute => $methods){
            //Válida se URI está no padrão
            if(preg_match($patternRoute, $uri, $matches)){
                if(isset($methods[$httpMethod])){
                    unset($matches[0]);

                    //chaves vindas da URL
                    $keys = $methods[$httpMethod]['variables'];
                    
                    //variaveis processadas
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;
                    
                    return $methods[$httpMethod];
                }
                
                throw new Exception("Método não permitido", 405);
                
            }
        }

        throw new Exception("URL não encontrada", 404);
    }

    /**
     * Método que retorna URI
     *
     * @return string
     */
    private function getUri(){
        $uri = $this->request->getUri();
        $xuri = strlen($this->prefix)? explode($this->prefix, $uri) : [$uri];
        
        //retorna somente o final da URI retirando o prefixo
        return end($xuri);
    }

}