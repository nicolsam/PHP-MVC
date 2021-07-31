<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Http\Response;
use \App\Controller\Pages\Home;

define('URL', 'http://localhost/mvcphp');


$obRouter = new Router(URL);

// echo '<pre>';
// print_r($obRouter);
// echo '</pre>';

// Rota Home

$obRouter->get('/', [
    function() {
        return new Response(200, Home::getHome());
    }
]);

// Imprime o Response da rota
$obRouter->run()
         ->sendResponse();