<?php 
namespace System\Core;
class Session
{
	
	function __construct()
	{
		
	}
	public static function init()
	{
		if (session_status() == 1) 
		{		    
			session_start();
		}
	}
	public static function destroy()
	{
		if (session_status() == PHP_SESSION_ACTIVE) 
		{		    
			session_destroy();
		}
	}
	public static function get($key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
	}
	public static function set($key,$value)
	{	
		$_SESSION[$key] = $value;
	}
}