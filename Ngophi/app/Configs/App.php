<?php


return [


	/*
	* Default title of page
	*/
	'APPLICATION_NAME'		=> 'Ngophi PHP Framework',
	/*
	* 
	*/
	'BASE_URL' 				=> 'http://'.$_SERVER['HTTP_HOST'] . '/Ngophi/public/',
	/*
	* Set default timezone 
	* Reference : http://php.net/manual/en/timezones.php
	*/
	'DEFAULT_TIMEZONE'		=> 'Asia/Jakarta',
	'DEBUG'					=> true,
	'APP_LANGUAGE'			=> 'EN',
	/*
	*	Database Configuration
	*	PDO Sql Server 	=> sqlsrv
	*	PDO MySql 		=> mysql
	*/
	'DBConfig'				=>  [
									'MOGH_DB'	=> [
										"DB_DRIVER" => "mysql",
										"DB_HOST" 	=> "localhost",
										"DB_PORT" 	=> "3306",
										"DB_NAME" 	=> "Mogh",
										"DB_USER" 	=> "root",
										"DB_PASS" 	=> "",
										"Query_Builder_Config" =>
										[
											"Sql_Logger_on"		=> true,
											"sql_Logger_Path"	=> true,
										]
								],
									'AKR_DB'	=> [
										"DB_DRIVER" => "sqlsrv",
										"DB_HOST" 	=> ".",
										"DB_PORT" 	=> "1433",
										"DB_NAME" 	=> "103AKR",
										"DB_USER" 	=> "sa",
										"DB_PASS" 	=> "pass@word1"
								]
	],









	"ERROR_PAGE_500"		=> 'errors/500',

	"ERROR_PAGE_400"		=> 'errors/400',

	/*
	* Directory path for controller files
	*/
	'CONTROLLER_PATH'		=> APPLICATION_PATH .'Controllers',
	/*
	* 
	*/
	'CONTROLLER_NAMESPACE'	=> 'app\\Controllers',

	/*
	* Directory path for view files
	*/
	'VIEW_PATH'				=> APPLICATION_PATH .'Views',

	/*
	* Extension for controller file
	*/
	'CONTROLLER_FILE_EXTENSION'	=> '.php',

	/*
	* Extension for controller file
	*/
	'VIEW_FILE_EXTENSION'	=> '.php',

	/*
	* Example 
	* Url 			: localhost/Home/Index
	* Controller 	: HomeController 
	* Controller class : class HomeController extends Controller {  }
	*/
	'CONTROLLER_PREFIX'		=> 'Controller',

	/*
	* Example 
	* Url 			: localhost/Home/Index
	* Action 		: IndexAction 
	* Method 		: function IndexAction() {  }
	*/
	'ACTION_PREFIX'			=> 'Action'
];


