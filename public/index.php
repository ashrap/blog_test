<?php

$public_path =  __DIR__;


require '../vendor/autoload.php';



require '../bootstrap.php';




$router = new Router;

require '../routes.php'; 



$router->direct( Request::uri(), Request::method() );


















