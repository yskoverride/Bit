<?php

namespace Bit\Core;

/**
 * Sessions
 */
class Sessions
{
  /**
   * Initiates session
   * @return NULL
   */
  public function initiate()
  {
    if (! isset($_SESSION)) {

      session_start();

    }
  }

  /**
   * sets session keys
   * @param mixed $key   [name]
   * @param mixed $value [value]
   */
  public function set($key, $value)
  {
      $_SESSION[$key] = $value;
  }

  /**
   * gets session key values
   * @param  mixed $key [name]
   * @return mixed      [value]
   */
  public function get($key)
  {
    if (isset($_SESSION[$key]))
      return $_SESSION[$key];
  }

  /**
   * unsets the session key
   * @param  mixed $key [name]
   * @return NULL
   */
  public function unset($key)
  {
    if (isset($_SESSION[$key]))
      unset($_SESSION[$key]);
  }

  /**
   * clears all session variables
   */
  public function clear()
  {
    $_SESSION = [];
  }
  
}
