<?php

namespace Bit\Controllers;

use Bit\Core\Response;

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
    $name = 'Super ranger';

    Response::view('ranger',compact('name'));
  }
}
