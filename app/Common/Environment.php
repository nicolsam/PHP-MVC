<?php

namespace App\Common;

class Environment {

    /**
     * Método responsável por carregar as variáveis de ambiente do projeto
     *
     * @param   string  $dir  Caminho absoluto da pasta onde encontra-se o arquivo .env
     */
    public static function load($dir) {
        // Verifica se o arquivo .env existe
        if(!file_exists($dir . '/.env')) {
            return false;
        }

        // Define as variáveis de ambiente
        $lines = file($dir . '/.env');

        // echo '<pre>';
        // print_r($lines);
        // echo '</pre>'; exit;

        foreach($lines as $line) {
            putenv(trim($line));
        }

    }
}