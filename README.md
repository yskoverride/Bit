# A bit of everything

### Tried to make a MVC framework, do not know how it will end..

### My Urge to build this..

For all the documentations and videos i followed to learn programming, some
concepts seemed bit overwhelming. Therefore, i started copying and pasting a
lot of code to get things completed. Everything worked very well until i
asked myself, will i ever try to understand WHAT and HOW.

## Overview

A bit of framework which tries to simplify creating php web projects.

## Usage

### Routes
Define your routes at src/Core/routes.php

Adding a new routes

```php
$router->get('about','PagesController@about');
$router->post('contact','ContactsController@save');

```
'get' and 'post' are the request types, you can additionally use 'delete' & 'patch'

'about' and 'contact' are the requested URL.

'PagesController' is the name of the Controller.

'about' and 'save' are the methods declared inside their controllers.

'@' is used as a separator.


### Controllers

All controllers must be placed inside src/Controllers folder. ( A bit opinionated :) )


### Request
User request can be handled with various methods of Request class.

Capture the URL of the request

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
Here the $field is the name of the anticipated field.


Capture a specific $_POST value of the request
```php
Request::request($field);
```
Here the $field is the name of the anticipated field.


Capture all the $_POST values of request
```php
Request::all();
```

Capture all the properties uploaded files
```php
Request::file();
```


### Response

Bit supports two types of responses, View and JSON

Respond as a view page
```php
Response::view('viewfile',$dataToBePassed);
```
*viewfile* is the name of placed in view folder,
viewfile can be of names *.view.php or *.php or *.html

*$dataToBePassed* is the data variable that needs to be passed to the view


Respond with JSON data
```php
Response::json($data);
```

*$data* must be of type array


Example of the usage of request and response methods. We will try to display
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

### Sessions

Sessions in Bit can be manipulated with some of the methods defined in
the **Sessions** class.

Store a new Session data.
```php
Session::set($key,$value);
```
**$key** is the unique identifier of the data that can be stored in Session.
**$value** is the data that needs to be stored in session

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


### FileStorage

Bit helps us to deal with files operations easily with LocalFileHandler class.
You can also use third party packages like flysystem, but the adapter class must
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


### Databases

Bit makes interaction with variety of databases easy. It uses the QueryBuilder
class which acts as a wrapper around php's PDO class. It supports all the
database types which is supported by PDO. So, you need to make sure that PDO drivers
for the database type is installed in the system.

Configurations for the database can be defined in the configs.php file,
explanation has been provided in the later part of this documentation.

QueryBuilder class is already bound to App container already. So it can be
acccesed with App::get('database')

Retrieving data from a table
```php
App::get('database')->selectAll($tablename);
```


Retrieving data from particular columns from a table
```php
App::get('database')->select($tablename, $parameters);
```
**$parameters** can be single value or an array


Executing Raw SQl queries
```php
App::get('database')->query($query, $clauses);
```
**$query** is the prepared statement e.g.
```sql
select * from Orders where OrderID = :orderID and Customer = :Customer
```
**$clauses** must be an associative array of column names and values which
are defined in the prepared statement $query, e.g.
```php
$clauses = ['orderID' => 23, 'Customer' => 'John'];
```



### Models
The concept of Model in MVC (Real World) is still bit unclear for me. In Bit Models
are like collaborator which deals with data of a particular table only.
Feel free to add business logic to these.

Models should be placed in the Models Folder. You can extend the BaseModel class
in your Model class to take advantage of the simple data manipulation methods.

If your model extends BaseModel class then it must declare the table() property.

```php
namespace Bit\Models;

/**
 * Order Model
 */
class Order extends BaseModel
{
    //Should return the tablename
    //which this Model will deal with

    protected function table()
    {
        return 'Orders';
    }

}
```

Some of the methods for handling data are

Finds all records based on provided conditions
```php
$values = ['orderID' => 23, 'Customer' => 'John'];

(new Order)->find($values);
```

Finds first record based on provided conditions
```php
$values = ['order' => 'Expresso'];

(new Order)->findFirst($values);
```


Get all the data of the Model
```php
(new Order)->findAll();
```


Save data in Model
```php
$data = ['order' => 'Expresso', 'table' => 4, 'quantity' => 'min',
                                            'Customer' => 'smith'];
(new Order)->save($data);
```
You can only save one record at a time


Update data in Model
```php
$newValues = ['order' => 'latte', 'quantity' => 'max'];

$conditions = ['orderID' => 43, 'Customer' => 'smith'];

(new Order)->update($newValues, $conditions);
```


Delete data from the Model
```php
$cancelOrder = ['Customer' => 'smith'];

(new Order)->delete($cancelOrder);
```



### Authentication

Authentication in Bit is just bare bones. LocalAuthentication class is
responsible for handling authentication, it only uses php sessions, nothing more
fancy. It implements the AuthenticationInterface. You can replace it with
any other authentication types like JWT, but make sure to implement the interface
AuthenticationInterface.

LocalAuthentication is bound to the App Container and can be accessed by
App::get('auth')

Log a user into the system

```php
App::get('auth')->login($user, $redirectPath);
```
**$user** is associative array of clauses to check if record exists in table
**$redirectPath** is the route path where user will be redirected if credentials
match.

Example
```php
namespace Bit\Controllers;

use Bit\Core\Response;
use Bit\Core\Request;
use Bit\Core\App;

/**
 * UserController
 */
class UserController
{
  public function loginpage()
  {   
      //In the example we are hard coding,
      //in your case it should have come from
      //Request::all() or $_POST values

      $user = [ 'email' =>'ranger@rick.com',
                'password' => 'myPasswordIsComplicated',];

      //User will be redirected to 'logged' route if
      //credentials matches the data in User table

      App::get('auth')->login($user,'logged');
  }
```


Log a user out of the system

```php
App::get('auth')->logout($redirectPath);
```
**$redirectPath** is the route where user will be redirected


Check if a user is logged in or not

```php
App::get('auth')->check($redirectPath);
```
**$redirectPath** is the route where user will be redirected if system finds
that the request did not came from logged in user.

This method can act as a guard to restrict users from accessing resources or
pages which is meant for logged in user only.

Example
```php
namespace Bit\Controllers;

use Bit\Core\Response;
use Bit\Core\Request;
use Bit\Core\App;
use Bit\Models\User;

/**
 * UserController
 */
class UserController
{
  public function profile()
  {   
      //user will be redirected to 'login' route
      // in case system finds user is not logged in

      App::get('auth')->check('login');

      $user = Request::request($userID);

      $userData = (new User)->findFirst($user);

      Response::view('UserProfile',compact('userData'));

  }
```



### App Container

App Container sounds overwhelming but, in Bit its just a class which can saves
various kind of values by keys.Think of it as an associative array. Its only
purpose is to access objects easily.

Do not try to make it more complicated.

New Configurations and objects can be bound to app class in the
src/Core/Bindings.php page

```php
App::bind('keyname', new YourObject())

App::get('keyname')
```
'keyname' is the name of the key, which can be used later to retrive the value.

App::bind() binds values to App Container
App::get() retrives the value bound by keyname


#### Configurations
You can define various types of configurations in the configs.php file.
This file expects a return type of array. This file can be excluded from the
version control to avoid sensitive data to be part of package.

Define your database configurations

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
  'type' => 'tsl',
    ...........................
]
```


Bind your new configs in src/Core/Bindings.php

```php
App::bind('mail' , App::get('configs')['mail']));

```

....more improvements underway
