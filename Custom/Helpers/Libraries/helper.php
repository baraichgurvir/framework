<?php

use Symfony\Component\Dotenv\Dotenv;

function execute($callback) {
    $callback();
};

function isArray(mixed $mixed) {
    if (is_array($mixed)) {
        return true;
    } else {
        return false;
    }
}

function preArray(array $array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function arrayToObject(array $array) {
    return json_decode(json_encode($array));
}

function evaluate(string $html) {
    eval("?> $html <?php");
}

function fileContents(string $file) {
    return file_get_contents($file);
}

function base($path = '') {
    return dirname(dirname(dirname(__DIR__))) . "/" . $path;
}

function conCat() {
    $args = func_get_args();
    $string = "";

    foreach ($args as $arg) {
        $string .= $arg;
    }

    return $string;
}

/** Load Environment Variables */
$dotenv = new Dotenv();
$dotenv->load(base().'.env');
function medio() {
    return arrayToObject($_ENV);
}