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
     * POST values
     * @param  string $value [post field name]
     * @return mixed        [values]
     */
    public static function request($value)
    {
        if (isset ($_POST[$value])) {

          return htmlspecialchars($_POST[$value]);

        }

        throw new \Exception("Request not found");

    }

    /**
     * GET values
     * @param  string $value [post field name]
     * @return mixed        [values]
     */
    public static function query($value)
    {
        if (isset ($_GET[$value])) {

          return htmlspecialchars($_GET[$value]);

        }

        throw new \Exception("Query not found");
    }

    /**
     * gets all the post variables
     * @return array $_POST [values]
     */
    public static function all()
    {

      $all = [];

      foreach ($_POST as $key => $value) {

        $all[$key] = htmlspecialchars($value);

      }

      return $all;

    }

    /**
     * gets uploaded file
     * @param  string $value [field name]
     * @return array        [file properties]
     */
    public static function file($value)
    {
      if (isset($_FILES[$value])) {

        return $_FILES[$value];

      }

      throw new \Exception("requested file not found");

    }
}
