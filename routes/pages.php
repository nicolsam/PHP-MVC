<?php

// Mostrar erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

use \App\Http\Response;
use \App\Controller\Pages;

// Rota HOME
$obRouter->get('/', [
    function() {
        return new Response(200, Pages\Home::getHome());
    }
]);

// Rota SOBRE
$obRouter->get('/sobre', [
    function() {
        return new Response(200, Pages\About::getAbout());
    }
]);

// Rota DEPOIMENTOS
$obRouter->get('/depoimentos', [
    function() {
        return new Response(200, Pages\Testimony::getTestimonies());
    }
]);

// Rota DEPOIMENTOS (INSERT)
$obRouter->post('/depoimentos', [
    function($request) {
        return new Response(200, Pages\Testimony::insertTestimony($request));
    }
]);