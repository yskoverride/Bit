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
    echo "I tried to be Minimal...";

  }

  public function contact()
  {
    $contacts = App::get('database')->selectAll('contacts');

    Response::view('contact',compact('contacts'));
  }

  public function contactus()
  {
    $name = Request::input('name');
    $address = Request::input('address');

    $parameters  = array('name' => $name, 'address' => $address);

    App::get('database')->insert('contacts',$parameters);

    header('Location: /contact');

  }

  public function ranger()
  {
    $result = App::get('database')->selectAll('users');

    $name = $result[1]->username;

    Response::view('ranger',compact('name'));
  }

  public function profile()
  {
    Response::view('profile');
  }

  public function profileupload()
  {

    $destination = __DIR__.'/../../uploads';

    try {

      $uploaded = Request::file('file');

      App::get('filesystem')->copy($uploaded, $destination);

    } catch (\Exception $e) {

      echo $e->getMessage();
    }



  }
}
