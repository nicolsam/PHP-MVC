<?php

namespace App\Http;

use \App\Http\Request;
use \Closure;
use \Exception;

/**
 * Classe gerenciadora de rotas
 */
class Router {

    /**
     * URL completa do projeto (raiz)
     * @var string
     */
    private $url = '';

    /**
     * Prefixo de todas as rotas
     *
     * @var string
     */
    private $prefix = '';

    /**
     * Índice de rotas
     *
     * @var array
     */
    private $routes = [];

    /**
     * Instância de Request
     *
     * @var Request
     */
    private $request;

    /**
     * Método responsável por iniciar a classe
     *
     * @param string $url
     */
    public function __construct($url) {
        $this->request = new Request();
        $this->url     = $url;

        $this->setPrefix();
    }

    /**
     * Método responsável por definir o prefixo das rotas
     */
    private function setPrefix() {
        // Informações da URL
        $parseUrl = parse_url($this->url);

        // Define o Prefixo
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Método responsável por adicionar uma rota na classe
     *
     * @param   string  $method 
     * @param   string  $route  
     * @param   array  $params  
     */
    private function addRoute($method, $route, $params = []) {
        // Validação dos Parâmetros
        foreach($params as $key => $value) {
            if($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        // Padrão de validação
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        // Adiciona a rota dentro da classe
        $this->routes[$patternRoute][$method] = $params;
        
        
    }
 
    /**
     * Método responsável por definir uma rota de GET
     *
     * @param   string  $route 
     * @param   array  $params 
     */
    public function get($route, $params = []) {
        return $this->addRoute('GET', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de POST
     *
     * @param   string  $route 
     * @param   array  $params 
     */
    public function post($route, $params = []) {
        return $this->addRoute('POST', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de PUT
     *
     * @param   string  $route 
     * @param   array  $params 
     */
    public function put($route, $params = []) {
        return $this->addRoute('PUT', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de DELETE
     *
     * @param   string  $route 
     * @param   array  $params 
     */
    public function delete($route, $params = []) {
        return $this->addRoute('DELETE', $route, $params);
    }
    
    /**
     * Método responsável por retornar a URI desconsiderando o prefixo
     * @return string
     */
    private function getUri() {
        // URI da request
        $uri = $this->request->getUri();
        
        // Fatia a URI com o prefixo
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        // Retorna a URI sem prefix
        return end($xUri);
    }

    /**
     * Método responsável por retornar os dados da rota atual
     * @return array
     */
    private function getRoute() {
        // uri
        $uri = $this->getUri();

        // Method
        $httpMethod = $this->request->getHttpRequest();


        
        // Valida as rotas
        foreach($this->routes as $patternRoute => $methods) {
            // Verifica se a rota bate o padrão
            if(preg_match($patternRoute, $uri)) {
                // Verifica o método
                if($methods[$httpMethod]) {

                    // Retorno dos parâmetros da rota
                    return $methods[$httpMethod];
                }
                
                // Método não permitido/definido
                throw new Exception("Método não permitido", 405);
                
            }
        }
        
        // URL não encontrada
        throw new Exception("URL não encontrada", 404);
    }

    /**
     * Método responsável por executar a rota atual
     * @return Response
     */
    public function run() {
        try {
            // Obtém a rota atual
            $route = $this->getRoute();
            
            // Verifica o controlador
            if(!isset($route['controller'])) {
                throw new Exception("URL não pôde ser processada", 500);
            }

            // Argumentos da função
            $args = []; 

            // Retorna a execução da função
            return call_user_func_array($route['controller'], $args);

        } catch(Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }


}