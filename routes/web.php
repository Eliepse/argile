<?php

use App\Http\Controllers\WelcomeController;
use Eliepse\Argile\Http\Router;

Router::get('/', WelcomeController::class);