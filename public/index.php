<?php
declare(strict_types=1);
mb_internal_encoding("UTF-8");

use Eliepse\Argile\Core\Application;

require __DIR__ . "/../bootstrap/bootstrap.php";

$app = Application::getInstance();

// Setup routes
include_once __DIR__ . '/../routes/web.php';

$app->run();
