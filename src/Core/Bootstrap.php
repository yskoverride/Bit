<?php

require __DIR__.'/../../vendor/autoload.php';

use Bit\Core\{Router,Request};

//Routes path
$routes = realpath(__DIR__.'/../routes.php');

//Loads routes and dispatches request
try {

  Router::loadRoutes($routes)->dispatch(Request::url(), Request::method());

} catch (\Exception $e) {

  echo $e->getMessage() ;
}
