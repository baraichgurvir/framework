<?php

namespace Framework\Helpers\Traits;

trait BrowserRequest{
    private function browserRequest() {
        self::$request = arrayToObject(["method" => $_SERVER['REQUEST_METHOD'], "path" => $_SERVER['REQUEST_URI']]);
    }
}