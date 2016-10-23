<?php

$router->get('','PagesController@home');
$router->get('contact','PagesController@contact');
$router->get('ranger','PagesController@ranger');
$router->post('contact','PagesController@contactus');

$router->post('profile','PagesController@profileupload');
$router->get('profile','PagesController@profile');
