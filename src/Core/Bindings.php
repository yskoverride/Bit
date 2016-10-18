<?php

use Bit\Core\Database\{Connection,QueryBuilder};
use Bit\Core\App;

$configs = require_once __DIR__.'/../../configs.php';

//Binding Configurations files to Container
App::bind('configs', $configs);

//Binding Database to Container
App::bind('database', new QueryBuilder(
                          Connection::connectToDB(
                          App::get('configs')['database'])));
