<?php

namespace App\Http\Middleware;

class Queue {
    
    /**
     * Mapeamento de Middlewares
     * @var array
     */
    private static $map = [];

    /**
     * Mapeamento de Middlewares que serão carregados em todas as rotas
     * @var array
     */
    private static $default = [];

    /**
     * Fila de Middlewares a serem executados
     * @var array
     */
    private $middlewares = [];

    /**
     * Função de executação do controlador
     *
     * @var Closure
     */
    private $controller;

    /**
     * Argumentos da função do controlador
     * @var array
     */
    private $controllerArgs = [];

    /**
     * Método responsável por construir a classe de fila de Middlewares
     *
     * @param array $middlewares
     * @param Closure $controller
     * @param array $controllerArgs
     *
     * @return [type]
     */
    public function __construct($middlewares, $controller, $controllerArgs) {
        $this->middlewares    = array_merge(self::$default, $middlewares);
        $this->controller     = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    /**
     * Método responsável por definir o mapeamento de Middlewares
     *
     * @param array $map
     *
     */
    public static function setMap($map) {
        self::$map = $map;
    }

     /**
     * Método responsável por definir o mapeamento de Middlewares padrões
     *
     * @param array $default
     *
     */
    public static function setDefault($default) {
        self::$default = $default;
    }
    

    /**
     * Método responsável por executar o próximo nível da fila de Middlewares
     * @param Request $request
     * @return Response
     */
    public function next($request) {
        // Verifica se a fila está vazia
        if(empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        // Middleware
        $middleware = array_shift($this->middlewares);

        // Verifica o Mapeamento
        if(!isset(self::$map[$middleware])) {
            throw new \Exception("Problemas ao processar o Middleware da requisição.", 500);
        }
        
        // Next
        $queue = $this;
        $next = function($request) use($queue) {
            return $queue->next($request);
        };

        // Executa o Middleware
        return (new self::$map[$middleware])->handle($request, $next);

    }

}