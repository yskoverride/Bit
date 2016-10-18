<?php

namespace Bit\Controllers;

use Bit\Core\Response;
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
    echo "When you try to contact me look around...";
  }

  public function ranger()
  {
    $result = App::get('database')->selectAll('users');

    $name = $result[1]->username;

    Response::view('ranger',compact('name'));
  }
}
