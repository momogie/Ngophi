<?php
/**
* 
*/
namespace System\Core;
class Config 
{
	public static function Configs()
	{
		return (require APPLICATION_PATH .'Configs/App.php');
	}
	static function  get($key)
	{
		if(!array_key_exists($key,self::Configs()))
			throw new RuntimeError("Config " . $key . ' not found!');
		
		return self::Configs()[$key];
	}
}