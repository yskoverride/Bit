<?php

namespace Bit\Core\Auth;

use Bit\Core\Sessions;
use Bit\Models\User;

/**
 * LocalAuthentication
 */
class LocalAuthentication implements AuthenticationInterface
{

  protected $session;
  protected $user;

  public function __construct(Sessions $session, User $user)
  {
    $this->session = $session;
    $this->user = $user;
  }

  /**
   * Set user session
   * @param  array $value       [email & password]
   * @param  string $destination [redirect URL]
   * @return NULL
   */
  public function login($value = [], $destination = '/')
  {

    try {

      $user = $this->user->findFirst($value);

      if (empty($user))

      throw new \Exception("Email and password does not match");

      if (! isset($user->email))

      throw new \Exception("Email property not found");

      $this->session->set('user', $user->email);

      header("Location: {$destination}");

    } catch (\Exception $e) {

      echo $e->getMessage();
      return;

    }


  }

  /**
   * Check if user session is set
   * @param  string $destination [redirect URL]
   * @return NULL
   */
  public function check($destination = '/login')
  {
     if (! $this->session->get('user'))

     header("Location: {$destination}");

  }

  /**
   * Unset user session
   * @param  string $destination [redirect URL]
   * @return NULL
   */
  public function logout($destination = '/login')
  {

    if ( $this->session->get('user')){

      $this->session->unset('user');

      header("Location: {$destination}");

    }


  }

}
