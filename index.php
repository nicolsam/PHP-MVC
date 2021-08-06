<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;
use \App\Common\Environment;

// Carrega variáveis de ambiente
Environment::load(__DIR__);

// echo '<pre>';
// print_r(getenv('URL'));
// echo '</pre>'; exit;

define('URL', getenv('URL'));

// Define o valor padrão das variáveis
View::init([
    'URL' => URL
]);

// Inicia o router
$obRouter = new Router(URL);

// Inclui as rotas de páginas
include __DIR__ . '/routes/pages.php';

// Imprime o Response da rota
$obRouter->run()
         ->sendResponse();