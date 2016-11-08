<?php

namespace Bit\Models;

use Bit\Core\Database\QueryBuilder;

use Bit\Core\App;

/**
 * User Model
 */
class User
{

  /**
   * finds user
   * @param  array $value   [email & password]
   * @return string        [user email]
   */
  public function find($value = [])
  {

    $statement = "Select * from users where email = :email and password = :password";

    $result = App::get('database')->query($statement,$value);

    if (empty($result))

    throw new \Exception("Email and password does not match");

    if (! isset($result[0]->email))

    throw new \Exception("Email property not found");

    return $result[0]->email;

  }

}
