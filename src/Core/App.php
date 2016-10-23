<?php

namespace Bit\Core;

/**
 * App Container
 */
class App
{

  protected static $registry = [];

  /**
   * Bind Values to Container
   * @param  string $key   [keyname]
   * @param  string $value [value]
   * @return NULL
   */
  public static function bind($key, $value)
  {
      static::$registry[$key] = $value;
  }

  /**
   * Returns saved key value
   * @param  string $key [keyname]
   * @return mixed $value
   */
  public static function get($key)
  {
      if (! array_key_exists($key, static::$registry)) {

        throw new \Exception("No {$key} is bound to the container");

      }

      return static::$registry[$key];
  }

}
