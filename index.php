<?php

require __DIR__.'/vendor/autoload.php';

use \App\Controller\Pages\Home;

$obrequest = new \App\Http\Response(400, "Olá mundo");

$obrequest->sendResponse();

echo Home::getHome();