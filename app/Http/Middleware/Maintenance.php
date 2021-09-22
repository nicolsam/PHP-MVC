<?php

namespace App\Http\Middleware;

class Maintenance {

    /**
     * Método responsável por executar o Middleware
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return Response
     */
    public function handle($request, $next) {
        // Verifica o estado de manutenção
        if(getenv('MAINTENANCE') == 'true') {
            throw new \Exception('Página em manutenção. Por favor, volte mais tarde.', 200);
        }

        // Executa o próximo nível do Middleware
        return $next($request);
    }

}