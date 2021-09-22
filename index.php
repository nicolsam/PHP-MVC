<?php

// Mostrar erros
error_reporting(E_ALL);
ini_set('display_errors', '1');


require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/bootstrap/app.php';

use \App\Http\Router;


// Inicia o router
$obRouter = new Router(URL);

// Inclui as rotas de páginas
include __DIR__ . '/routes/pages.php';

// Imprime o Response da rota
$obRouter->run()
         ->sendResponse();