<?php

$router->get('','PagesController@home');
$router->get('login','PagesController@loginpage');
$router->get('logged','PagesController@logged');
$router->get('logout','PagesController@loggedout');
$router->get('about','PagesController@about');
$router->get('notlogged','PagesController@notlogged');
