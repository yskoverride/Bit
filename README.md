# A bit of everything

### Trying to make a MVC framework, do not know how it will end..

### My Urge to build this..

For all the documentations and videos i followed to learn programming, some
concepts seemed bit overwhelming. Therefore, i started copying and pasting a
lot of code to get things completed. Everything worked very well until i
asked myself, will i ever try to understand WHAT and HOW.

## Overview

A bit of framework which tries to simplfy creating php web projects.

## Usage

#### Routes
Define your routes at src/Core/routes.php

Adding a new routes

```php
$router->get('about','PagesController@about');
$router->post('contact','ContactsController@save');

```
'get' and 'post' are the request types, you can additionally use 'delete' & 'patch'

'about' and 'contact' are the requested urls.

'PagesController' is the name of the Controller.

'about' and 'save' are the methods declared inside their controllers.

'@' is used as a seperator.

### Controllers

All controllers must be placed inside src/Controllers folder. ( A bit opinionated :) )


#### Request
User request can be handled with various methods of Request class.

Capture the url of the request
```php
Request::url();
```

Capture request method (get,post, patch ...)
```php
Request::method();
```

Capture a specific $_GET value of the request
```php
Request::query($field);
```
here the $field is the name of the anticipated field.


Capture a specific $_POST value of the request
```php
Request::request($field);
```
here the $field is the name of the anticipated field.


Capture all the $_POST values of request
```php
Request::all();
```

Capture all the properties of $_FILES values of request
```php
Request::file();
```


###Response

Bit supports two types of responses, View and JSON

Respond as a view page
```php
Response::view('viewfile',$dataToBePassed);
```
*viewfile* is the name of viewfile placed in view folder
viewfile can be of names *.view.php or *.php or *.html

*$dataToBePassed* is the data needs to be passed to the view


Respond with JSON data
```php
Response::json($data);
```

*$data* must be of type array


Example of usage of request and response methods. We will try to display
the data entered by user

```php

namespace Bit\Controllers;

use Bit\Core\Response;
use Bit\Core\Request;

/**
 * OrderController
 */
class OrderController
{
  public function newOrder()
  {
    $userOrder = [];

    //Request::all() will provide all the $_POST values
    foreach(Request::all() as $field => $value)
    {
      $userOrder[$field] = $value;
    }

    //ConfirmOrder is the view page and we are passing user's
    //entered data to this view with array $userOrder
    Response::view('ConfirmOrder',compact($userOrder));

  }

}
```

###Sessions
Sessions in Bit can be manipulated with some of the methods defined in
the **Sessions** class.

Store a new Session data.
```php
Session::set($key,$value);
```
**$key** is the unique identifier of the data that can be stored in Session.
**$value** data that needs to be stored in session data

Retrieving Session data
```php
Session::get($key);
```
**$key** is the unique identifier of the data that was previously saved

Destroy specific Session data
```php
Session::unset($key);
```

Destroy all the Session data
```php
Session::clear();
```


###FileStorage

Bit helps us to deal with files operations easily with LocalFileHandler class.
We can also use third party packages like flysystem, but the adapter class must
implement FileHandlerInterface. Unlike other classes it does not use Static
methods.

The LocalFileHandler class is already bound to App Container, so there is no
need to instantiate it.

Get file name
```php
$uploadedFile = Request::file();
App::get('filesystem')->getfilename($uploadedFile);
```

Get file size
```php
$uploadedFile = Request::file();
App::get('filesystem')->getsize($uploadedFile);
```

Get file extension
```php
$uploadedFile = Request::file();
App::get('filesystem')->getextension($uploadedFile);
```

Copy File to a new destination
```php
$uploadedFile = Request::file();
App::get('filesystem')->copy($uploadedFile, $destination);
```

Delete file at a location
```php
App::get('filesystem')->delete($filepath);
```

Create a new directory
```php
App::get('filesystem')->createDir($directoryPath, $permissions);
```
**$permissions** signifies the directory permissions, its defaults to 755




#### App Container

Configurations and objects can be bound to App Container and could later be retrived

```php
App::bind('keyname', new YourObject())

App::get('keyname')

```
'keyname' is the name of the key, which can be used later to retrive the value.
App::bind() binds values to App Container
App::get() retrives the value bound by keyname


#### Configurations

Define your database configurations at configs.php

```php
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

```php
'mail' => [
  'driver' => 'mailchimp',
  'apikey' => '124scs5$34jsd',
    ...........................
]
```
Bind your new configs in src/Core/Bindings.php

```php
App::bind('mail' , App::get('configs')['mail']));

```


Contd...
