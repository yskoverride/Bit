<?php

namespace Bit\Controllers;

use Bit\Core\Response;
use Bit\Core\Request;
use Bit\Core\App;


/**
 * PagesController
 */
class PagesController
{
  public function home()
  {

      // $users = App::get('database')->select('users',['name','email']);
    $email = 'Sunil.kumarya4@gmail.com';
    $query = "Select * from users where email = :email";

    $result = App::get('database')->query($query,[$email]);

    if (empty($result)) {
      echo "empty";
    }

    if (isset($result[0]->email)) {
      print_r($result[0]->email);
    }


  }

  public function loginpage()
  {

        $user = [ 'email' =>'Sunil.kumarya4@gmail.com',
                  'password' =>'$2a$06$.av8N5IhAOku927RzFL6vurwcrXrukuFe0iv7VxOdLg43njg3vHPq' ];

        App::get('auth')->login($user,'logged');
  }

  public function logged()
  {
      echo "You are now logged in as User...";
      return;
  }

  public function loggedout()
  {
      App::get('auth')->logout('notlogged');
  }


  public function about()
  {
    App::get('auth')->check('notlogged');

    echo "Hello all";
  }

  public function notlogged()
  {
    echo "You are not logged in";
    return;
  }

}
