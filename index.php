<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;

define('URL', 'http://localhost/mvcphp');

// Define o valor padrão das variáveis
View::init([
    'URL' => URL
]);

// Inicia o router
$obRouter = new Router(URL);

// echo '<pre>';
// print_r($obRouter);
// echo '</pre>';

// Inclui as rotas de páginas
include __DIR__ . '/routes/pages.php';

// Imprime o Response da rota
$obRouter->run()
         ->sendResponse();