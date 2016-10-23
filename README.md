# A bit of everything

### Trying to make a MVC framework, do not know how it will end..

### My Urge to build this..

For all the documentations and videos i followed to learn programming, some
concepts seemed bit overwhelming. Therefore, i started copying and pasting a
lot of code to get things completed. Everything worked very well util i
asked myself, will i ever try to understand WHAT and HOW.

## Overview

A bit of framework which tries to simplfy creating php web projects.

### WorkFlow

1. A user sends a request.
2. Router picks up the user request.
3. Request is redirected to appropriate Controller.
4. Controller does what needs to done.
5. Controller may or may not require a View.

## Usage

#### Routes
Define your routes at src/Core/routes.php

Adding a new routes

```
$router->get('about','PagesController@about');
$router->post('contact','ContactsController@save');

```
'get' and 'post' are the request types, you can additionally use 'delete' & 'patch'

'about' and 'contact' are the requested urls.

'PagesController' is the name of the Controller.

'about' and 'save' are the methods declared inside their controllers.

'@' is used as a seperator.

All controllers must be placed inside src/Controllers folder. ( A bit opinionated :) )

Use PagesController as an example.


#### App Container

Configurations and objects can be bound to App Container and could later be retrived

```
App::bind('keyname', new YourObject())

App::get('keyname')

```
'keyname' is the name of the key, which can be used later to retrive the value.
App::bind() binds values to App Container
App::get() retrives the value bound by keyname


#### Configurations

Define your database configurations at configs.php

```
'database' => [

  'dbdriver' => 'databasedriver',
  'dbname' => 'databasename',
  'host' => 'databasehost',
  'username' => 'databaseuser',
  'password' => 'password',
  'options' => ['other options']

]
```
configs file returns an associative array.

New configurations like caching and logging can be added to it.


#### Binding new configurations

You can bind new configurations by appending new values in configs.php

```
'mail' => [
  'driver' => 'maildriver',
  'apikey' => 'ssdvdsvdvdsdv',
    ...........................
]
```
Bind your new configs in src/Core/Bindings.php

```
App::bind('mail' , App::get('configs')['mail']));

```


Contd...
