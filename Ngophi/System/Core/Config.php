<?php
namespace System\Core;
class Config 
{
	private static $config;
	public static function All()
	{
		if(!isset(self::$config))
			self::$config = (require APPLICATION_PATH .'Configs/App.php');

		return self::$config;
	}

	static function get($key)
	{
		if(!array_key_exists($key,self::All()))
			throw new Exception\RuntimeException('Config "' . $key . '" not found!');
		
		return self::All()[$key];
	}
}