<?php

// COMPOSER - AUTOLOAD
require __DIR__ . '/../vendor/autoload.php';

use \App\Common\Environment;
use \App\Utils\View;
use \App\Bd\Model\Database;
use \App\Http\Middleware\Queue as MiddlewareQueue;

// Carrega as variáveis de ambiente do projeto
Environment::load(__DIR__ . "/../");

define('URL', getenv('URL'));

// Define o valor padrão das variáveis
View::init([
    'URL' => URL
]);

// Define o mapeamento de middlewares
MiddlewareQueue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class
]);

// Define o mapeamento de middlewares padrões, executado em todas as rotas
MiddlewareQueue::setDefault([
    'maintenance'
]);