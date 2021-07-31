<?php

namespace App\Http;

class Response {

    /**
     * Código do status HTTP
     *
     * @var integer
     */
    private $httpCode = 200;

    /**
     * Cabeçalho do Response
     *
     * @var array
     */
    private $headers = [];

    /**
     * Tipo de conteúdo que está sendo retornado
     *
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Conteúdo do Response
     *
     * @var mixed
     */
    private $content;

    /**
     * Método construtor
     *
     * @param   integer  $httpCode  
     * @param   mixed  $content      
     * @param   string  $contentType 
     *
     */
    public function __construct($httpCode, $content, $contentType = 'text/html') {
        $this->httpCode = $httpCode;
        $this->content  = $content;  
        $this->setContentType($contentType);   
    }

    /**
     * Método responsável por alterar o valor do contentType do Response
     *
     * @param string $contentType 
     *
     */
    public function setContentType($contentType) {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * Método responsável por adicionar um registro no cabeçalho do Response
     *
     * @param   string  $key    
     * @param   string  $value  
     */
    public function addHeader($key, $value) {
        $this->headers[$key] = $value;
    }

    /**
     * Método responsável por enviar os Headers para o navegador
     */
    private function sendHeaders() {
        // Definir status
        http_response_code($this->httpCode);

        // Enviar headers
        foreach($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    /**
     * Método responsável por enviar a resposta para o usuário
     */
    public function sendResponse() {
        // Enviar Headers
        $this->sendHeaders();

        // Imprime conteúdo
        switch($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }
}