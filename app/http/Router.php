<?php

namespace App\Http;

use \Closure;
use NoRewindIterator;

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

        $patternRoute ='/^'.str_replace('/', '\/', $route).'$/';
    }

    /**
     * Método responsavel por definir uma rota de GET
     * @param string $route
     * @param array $params
     */
    public function get($route, $params = []){

    }

}