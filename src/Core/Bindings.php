<?php

use Bit\Core\Database\{Connection,QueryBuilder};
use Bit\Core\FileHandler\LocalFileHandler;
use Bit\Core\App;
use Bit\Core\Sessions;
use Bit\Models\User;
use Bit\Core\Auth\LocalAuthentication;

$configs = require_once __DIR__.'/../../configs.php';

//Binding Configurations files to Container
App::bind('configs', $configs);

//Binding Database to Container
App::bind('database', new QueryBuilder(
                          Connection::connectToDB(
                          App::get('configs')['database'])));

//Binding Localfilesystem to Container
//Must implement FileHandlerInterface
App::bind('filesystem', new LocalFileHandler());

//Binding User Authentication to Container
//Must implement AuthenticationInterface
App::bind('auth' , new LocalAuthentication(new Sessions,new User));
