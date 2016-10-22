<?php

namespace Bit\Core;

class Request
{
    /**
     * gets request url
     * @return string [REQUEST_URI]
     */
    public static function url()
    {
       return trim(parse_url(@$_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');
    }

    /**
     * gets request method
     * @return string [REQUEST_METHOD]
     */
    public static function method()
    {
        return @$_SERVER['REQUEST_METHOD'];
    }

    /**
     * gets get and post values
     * @param  string $value [get and post]
     * @return mixed        values
     */
    public static function input($value)
    {
        if (isset ($_POST[$value])) {

          return htmlspecialchars($_POST[$value]);

        }

        if (isset ($_GET[$value])) {

          return htmlspecialchars($_GET[$value]);

        }

        throw new \Exception("Request not found");

    }

    /**
     * gets all the post variables
     * @return array $_POST values
     */
    public static function all()
    {

      $all = [];

      foreach ($_POST as $key => $value) {

        $all[$key] = htmlspecialchars($value);

      }

      return $all;

    }
}
