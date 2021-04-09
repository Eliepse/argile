<?php
declare(strict_types=1);
mb_internal_encoding("UTF-8");

use Eliepse\Argile\Core\Application;
use Eliepse\Argile\Http\Middleware\CompiledRouteMiddleware;
use Eliepse\Argile\Http\Middleware\ContentSecurityPolicyMiddleware;
use Eliepse\Argile\Http\Middleware\FlashFormInputsMiddleware;
use Eliepse\Argile\Http\Middleware\JsonBodyParserMiddleware;
use Eliepse\Argile\Http\Middleware\MaintenanceMiddleware;
use Eliepse\Argile\Http\Middleware\SecureFrameOptionMiddleware;
use Eliepse\Argile\Support\Env;
use Middlewares\PhpSession;
use Psr\Log\LoggerInterface;

require __DIR__ . "/../bootstrap/bootstrap.php";

$app = Application::getInstance();
$slim = $app->getSlim();

// Add global middlewares
$slim->addMiddleware(new FlashFormInputsMiddleware());
$slim->addMiddleware(new JsonBodyParserMiddleware());
$slim->addMiddleware(new SecureFrameOptionMiddleware());
$slim->addMiddleware(
	new ContentSecurityPolicyMiddleware(
		! $app->isProduction(),
		"'self' https://umami.eliepse.fr/",
		[
			"style-src" => "'self' 'unsafe-inline'",
			"script-src" => "'self' 'unsafe-inline' https://umami.eliepse.fr/",
		]
	)
);

$slim->addMiddleware(new MaintenanceMiddleware(! Env::get("APP_ONLINE")));
$slim->addMiddleware($app->resolve(PhpSession::class));
$slim->addMiddleware(new CompiledRouteMiddleware());
$slim->addRoutingMiddleware();
$slim->addErrorMiddleware(! $app->isProduction(), true, true, $app->resolve(LoggerInterface::class));

// Setup routes
include_once __DIR__ . '/../routes/web.php';

$app->run();
