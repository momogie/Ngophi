<?php

/**
* 
*/
namespace System\Core;

class Ngophi
{
	
	function __construct()
	{
		require_once('AutoLoader.php');
		new AutoLoader();

        set_exception_handler('System\Core\ErrorHandler::Exception');
        set_error_handler('System\Core\ErrorHandler::Error', error_reporting());
		error_reporting(0);
		if(Config::get('DEBUG')) error_reporting(E_ALL);
		
		require_once(SYSTEM_PATH . 'Core/global/Controls.php');
		require_once(SYSTEM_PATH . 'Core/global/Helper.php');
		Router::Execute(require APPLICATION_PATH .'configs/RouteCollections.php');
	}
}