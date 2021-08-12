<?php

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;

//URL do projeto, verificar e trocar de acordo com sua url inicial
define('URL', 'http://localhost/mvc-framework');

//Variáveis iniciadas Globais
View::init([
    'URL' => URL
]);

//instância de Router
$obRouter = new Router(URL);

//Inclui a rota das páginas
include __DIR__.'/routes/pages.php';


//Executa a rota e envia a resposta para a tela
$obRouter->run()->sendResponse();

