<?php

namespace App\Http\Controllers;

use Eliepse\Argile\Http\Responses\ViewResponse;
use Psr\Http\Message\ResponseInterface;

class WelcomeController
{
	public function __invoke(): ResponseInterface
	{
		return new ViewResponse("welcome", ["page" => "welcome"]);
	}
}