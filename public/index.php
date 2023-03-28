<?php

require "bootstrap.php";

use \App\Http\Router;
use App\Utils\View;

define('URL', 'http://route-system.test');

//DEFINE O VALOR PADRAO DAS VARIAVEIS
View::init([
    'URL' => URL
]);

$obRouter = new Router(URL);

//INCLUI A ROTA DE PAGINAS
include __DIR__ . '/../routes/pages.php';

//IMPRIME O RESPONSE DA ROTA
$obRouter->run()->sendResponse();

/* 
echo "<pre>";
print_r($obRequest);
exit; */