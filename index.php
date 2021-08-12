<?php

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;

define('URL', 'http://localhost/mvc-framework');

//valor padrão das variávies
View::init([
    'URL' => URL
]);

//instância de Router
$obRouter = new Router(URL);

//Inclui a rota das páginas
include __DIR__.'/routes/pages.php';


//Executa a rota e envia a resposta para a tela
$obRouter->run()->sendResponse();

