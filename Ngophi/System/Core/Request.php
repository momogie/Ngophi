<?php
namespace System\Core;
class Request
{
	/**
	* get data from GET method
	* Example : http://localhost:80/Home/Item/?itemid=20 Request::get('itemid'); == will return value 20
	* 
	*/		
	public static function get($name,$clean =false)
	{		
		return isset($_GET[$name]) ? ($clean ? Security::clean_str($_GET[$name]) : $_GET[$name]) : '';
	}

}