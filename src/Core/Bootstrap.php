<?php

require __DIR__.'/../../vendor/autoload.php';

use Bit\Core\{Router,Request};


use Bit\Core\Database\{Connection,QueryBuilder};
use Bit\Core\App;

$configs = require_once __DIR__.'/../../configs.php';

//Binding Configurations files to Container
App::bind('configs', $configs);

//Binding Database to Container
App::bind('database', new QueryBuilder(
                          Connection::connectToDB(
                          App::get('configs')['database'])));



//Routes path
$routes = realpath(__DIR__.'/../routes.php');

//Loads routes and dispatches request
try {

  Router::loadRoutes($routes)->dispatch(Request::url(), Request::method());

} catch (\Exception $e) {

  echo $e->getMessage() ;
}
