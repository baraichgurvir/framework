<?php

use Framework\Errors\Exception;
use Framework\Routing\Route;

echo '<style>*{font-family: "SF Mono", monospace}</style>';

/**
 * @package Framework
 * @author Gurvir Singh <baraichgurvir2007@email.com>
 * @version 1.0.0
 */

/** Required Files */
require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/Routes/web.php";

/** @onError */ new Exception();

/** Routing */
Route::liveChecks();
