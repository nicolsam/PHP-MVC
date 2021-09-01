<?php

// COMPOSER - AUTOLOAD
require __DIR__ . '/../vendor/autoload.php';

use \App\Common\Environment;
use \App\Utils\View;
use \App\Bd\Model\Database;

// Carrega as variáveis de ambiente do projeto
Environment::load(__DIR__ . "/../");

define('URL', getenv('URL'));

// Define o valor padrão das variáveis
View::init([
    'URL' => URL
]);