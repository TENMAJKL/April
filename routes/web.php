<?php

/**
 * This file contains web routes for end users
 */

use Kernel\Controllers\Auth\Login;
use Kernel\Controllers\Auth\Logout;
use Kernel\Controllers\Welcome;
use Kernel\Middleware\Authenticated;
use Kernel\Middleware\Guest;

Route::group(['middlewares' => Authenticated::class], [
    Route::controller('/', Welcome::class)
]);

Route::group(['middlewares' => Guest::class], [
    Route::controller('/login', Login::class)
]);

Route::get('/logout', [Logout::class, 'handle']);
