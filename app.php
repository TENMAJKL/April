<?php

use Lemon\Kernel\Application;
use Lemon\Sessions\Session;
use Lemon\Utils\Env;

Session::start();

define('APP_FOLDER', __DIR__);

/**
 * Initializes whole application
 */
$app = new Application(APP_FOLDER);

Env::setPath(APP_FOLDER);

/**
 * Setting folders to load
 */
$app->load(
    "routes"
);

// Setting view folder
$app->views("resources/views");

return $app;


