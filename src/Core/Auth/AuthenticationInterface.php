<?php

namespace Bit\Core\Auth;

interface AuthenticationInterface{

  public function login();
  public function check();
  public function logout();

}
