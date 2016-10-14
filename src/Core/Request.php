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
}
