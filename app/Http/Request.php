<?php

namespace App\Http;

class Request {

    /**
     * Método Http da requisição
     *
     * @var string 
     */
    private $httpMethod;

    /**
     * URI da pagina
     *
     * @var string
     */
    private $uri;

    /**
     * Parâmetros da URL ($_GET) 
     *
     * @var array
     */
    private $queryParams = [];
    
    /**
     * Variáveis recebidas no POST da página ($_POST)
     *
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     *
     * @var array
     */
    private $headers = [];

    /** 
     * Construtor da classe
     */
    public function __construct() {
        $this->queryParams = $_GET ?? [];
        $this->postVars    = $_POST ?? [];

        $this->headers     = getallheaders();

        $this->httpMethod  = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri         = $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * Método responsável por retornar o método da requisição
     *
     * @return  string
     */
    public function getHttpRequest() {
        return $this->httpMethod;
    }

    /**
     * Método responsável por retornar a URI da requisição
     *
     * @return  string
     */
    public function getUri() {
        return $this->uri;
    }
    
    /**
     * Método responsável por retornar os Headers da requisição
     *
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * Método responsável por retornar os parâmetros da URI da requisição
     *
     * @return array
     */
    public function getQueryParams() {
        return $this->queryParams;
    }

    /**
     * Método responsável por retornar as variáveis do POST da requisição
     *
     * @return array
     */
    public function getPostVars() {
        return $this->postVars;
    }

    
}