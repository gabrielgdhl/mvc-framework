<?php
namespace App\Http;


class Response {

    /**
     * Código de Status do HTTP Request
     *
     * @var integer
     */
    private $httpCode = 200;

    /**
     * Cabeçalho da requisição HTTP
     *
     * @var array
     */
    private $headers = [];

    /**
     * Conteúdo retornado
     *
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Conteúdo da response HTTP
     *
     * @var mixed
     */
    private $content;


    /**
     * Undocumented function
     *
     * @param integer $httCode
     * @param mixed $content
     * @param string $contentType
     */
    public function __construct($httCode, $content, $contentType = 'text/html'){
        $this->httpCode     = $httCode;
        $this->content      = $content;
        $this->setContentType($contentType);
    }

    /**
     * Método que altera o contentType no cabeçalho do response
     *
     * @param string $contentType
     */
    public function setContentType($contentType){
        $this->contentType  = $contentType;
        $this->addHeader('Content-Type', $this->contentType);
    }

    /**
     * Método que altera valores no cabeçalho
     *
     * @param string $key
     * @param mixed $value
     */
    public function addHeader($key, $value){
        $this->headers[$key] = $value;
    }

    /**
     * Método que monta e envia o cabeçalho da requisição
     *
     */
    private function sendHeaders(){
        //Código de Status
        http_response_code($this->httpCode);

        foreach($this->headers as $key => $value){
            header($key.':'.$value);
        }

    }

    /**
     * Método que envia resposta para usuario
     *
     * @return void
     */
    public function sendResponse(){
        $this->sendHeaders();
        switch($this->contentType){
            case 'text/html':
                echo $this->content;
            exit;
        }
    }
}