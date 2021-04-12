<?php
/** @noinspection PhpUnhandledExceptionInspection */

use Eliepse\Argile\Core\Application;
use Slim\Flash\Messages;

if (! function_exists('flash')) {
	function flash(): Messages
	{
		return Application::getInstance()->resolve(Messages::class);
	}
}

if (! function_exists('errors')) {
	function errors(string $key): array
	{
		$all_errors = flash()->getFirstMessage("errors");

		if (empty($all_errors))
			return [];

		if (! isset($all_errors[$key]))
			return [];

		$key_errors = $all_errors[$key];

		if (empty($key_errors))
			return [];

		return is_array($key_errors) ? $key_errors : [$key_errors];
	}
}

if (! function_exists("old")) {
	/**
	 * @param string $key
	 * @param mixed|string|null $default
	 *
	 * @return mixed
	 */
	function old(string $key, $default = null): mixed
	{
		return flash()->getFirstMessage("old.$key", $default);
	}
}