<?php
namespace System\Core;

class Controller
{
	public static $view;
	function __construct()
	{
		self::$view = new View();
	}

	
	public static function getInstance()
	{
		if (!isset(self::$view))
		{
			self::$view = new View();
		}
		return self::$view;
	}

	
	function __get($name)
	{
		if ($name == 'view')
		{
			return self::getInstance();
		}
		
		return isset($_POST[$name]) ? $_POST[$name] : null ;
	}


	function Post($key)
	{
		if (array_key_exists($key, $_POST))
		{
			return $_POST[$key];
		}
		return null;
	}

	
	function Get($key)
	{
		if (array_key_exists($key, $_GET))
		{
			return $_GET[$key];
		}

		return null;
	}


	function Validate($data)
	{
		self::getInstance()->validationresult = [];
		
		if(HTTP_POST)
		{
			return Validator\Validate::Execute($data,self::getInstance()->validationresult);
		}

		return false;
	}

	
}