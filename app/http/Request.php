<?php

namespace App\Http;

class Request {

    /**
     * Método Http (GET, POST, PUT, DELETE, PATCH)
     *
     * @var string
     */
    private $httpMethod;

    /**
     * URI da página
     *
     * @var [type]
     */
    private $uri;

    /**
     * Parâmetros do GET da URL
     *
     * @var array
     */
    private $queryParams = [];

    /**
     * Paramêtros do POST das páginas
     *
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho http
     *
     * @var array
     */
    private $headers = [];

    /**
     * Construtor da Classe Request
     */
    public function __construct(){
        $this->queryParams = $_GET ?? [];
        $this->postVars    = $_POST ?? [];
        $this->headers     = getallheaders();
        $this->httpMethod  = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri         = $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * Retorna HttpMethod
     *
     * @return string
     */
    public function getHttpMethod(){
        return $this->httpMethod;
    }

    /**
     * Retorna URI
     *
     * @return string
     */
    public function getUri(){
        return $this->uri;
    }

    /**
     * Retorna Headers
     *
     * @return string
     */
    public function getHeaders(){
        return $this->headers;
    }

    /**
     * Retorna Query Params
     *
     * @return string
     */
    public function getQueryParams(){
        return $this->queryParams;
    }
    
    /**
     * Retorna Post
     *
     * @return string
     */
    public function getPostVars(){
        return $this->postVars;
    }
}