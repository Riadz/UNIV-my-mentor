<?php

namespace App\Traits;

trait PinTrait
{
	private static function getPins()
	{
		$path = realpath(__DIR__ . "/../../../config/pin_code.php");

		if ($path !== false)
			return require($path);
		else
			throw new \Exception('cant find config/pin_code.php file');
	}
}
