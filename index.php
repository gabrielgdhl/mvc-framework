<?php

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use \App\Controller\Pages\Home;

define('URL', 'http://localhost/mvc-framework');

$ob = new Router(URL);
echo "<pre>";
print_r($ob);
echo "</pre>";
exit;
echo Home::getHome();