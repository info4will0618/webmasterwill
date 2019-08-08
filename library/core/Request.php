<?php

namespace WebMasterWill\Library\Core;

class Request
{
    /**
     * Fetch the request URI.
     *
     * @return string
     */
    public static function keys() {
        $keys = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        return $keys;
    }

    /**
     * Fetch the request method.
     *
     * @return string
     */
    public static function method() {
        return $_SERVER['REQUEST_METHOD'];
    }
}
