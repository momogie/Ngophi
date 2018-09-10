
<?php session_start();?>
<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/momogie/Mogh
*/
namespace System\Core;

class Session
{
	
	function __construct()
	{
		
	}
	public static function init()
	{
		if (session_status() == 1) {		    
			session_start();
		}
	}
	public static function destroy()
	{
		if (session_status() == PHP_SESSION_ACTIVE) {		    
			session_destroy();
		}
	}
	public static function get($key)
	{
		//self::init();
		//please decrypt your encrypted session
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
	}
	public static function set($key,$value)
	{	
		//self::init();
		//self::init();
		//please encrypt your session
		$_SESSION[$key] = $value;
	}
}