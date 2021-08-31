<?php

// COMPOSER - AUTOLOAD
require __DIR__ . '/../vendor/autoload.php';

use \App\Common\Environment;

// Carrega as variáveis de ambiente do projeto
Environment::load(__DIR__ . "/../");