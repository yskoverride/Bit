<?php

namespace Bit\Controllers;

use Bit\Core\Response;
use Bit\Core\Request;
use Bit\Core\App;
use Bit\Models\User;
use Bit\Helpers\Helpers;

/**
 * PagesController
 */
class PagesController
{
  public function home()
  {

    $user = new User;

    $values = [ 'password' => '123456a',
                'username' => 'Sushil',
                'email' => 'sushil.nayak45@gmail.com',
              ];
    //
    // // $conditions = ['id' => 6,
    //                 ];

    $results = $user->find($values);

    Helpers::dd($results);


  }

  public function loginpage()
  {
      $user = [ 'password' => '123456a',
                'email' =>'Sunil.kumarya4@gmail.com' ];

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
