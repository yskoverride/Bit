<?php

namespace Bit\Core;

/**
 * Response
 */
class Response
{

  /**
   * View file to be displayed
   * @param  string $file [view file name]
   * @param  array $data [data tobe passed to view]
   * @return file       [view file]
   */
  public static function view($file, $data = [])
  {


      if ( realpath(__DIR__."/../Views/{$file}.view.php")) {

        extract($data);

        return require realpath(__DIR__."/../Views/{$file}.view.php");

      }

      if (realpath(__DIR__."/../Views/{$file}.php")) {

        extract($data);

        return require realpath(__DIR__."/../Views/{$file}.php");

      }

      if (realpath(__DIR__."/../Views/{$file}.html")) {

        return require realpath(__DIR__."/../Views/{$file}.html");

      }

      throw new \Exception("View File not found in Views folder");

  }

  /**
   * returns JSON values
   * @param  mixed $value [value to output]
   * @return json        [json value]
   */
  public static function json($value)
  {
      if (! is_array($value)) {

        throw new Exception("Value to be converted to JSON must be an array");

      }

      echo json_encode($value);

      return ;
  }


}
