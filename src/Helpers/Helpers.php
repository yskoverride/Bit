<?php

namespace Bit\Helpers;

/**
 * Helpers
 */
class Helpers
{
  /**
   * Checks if the provided value is associative array
   * @param  array  $array [Array to be tested]
   * @return boolean
   */
  public static function is_associative($array = [])
  {
    foreach(array_keys($array) as $key)
  		if (!is_int($key)) return true;
  	return false;
  }

  /**
   * dies and var_dumps values
   * @param  mixed $value [value to be dumped]
   * @return mixed
   */
  public function dd($value)
  {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
  }
}
