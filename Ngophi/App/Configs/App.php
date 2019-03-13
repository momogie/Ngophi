<?php


return [
	/*
	 * Default title of page
	 */
	'APPLICATION_NAME' => 'Stayos',
	/*
	 * 
	 */
	'BASE_URL' => 'http://' . $_SERVER['HTTP_HOST'] . '/',
	/*
	 * Set default timezone 
	 * Reference : http://php.net/manual/en/timezones.php
	 */
	'DEFAULT_TIMEZONE' => 'Asia/Jakarta',
	'DEBUG' => true,
	'APP_LANGUAGE' => 'EN',
	/*
	 *	Database Configuration
	 *	PDO Sql Server 	=> sqlsrv
	 *	PDO MySql 		=> mysql
	 */
	'DBConfig' => [
		'LUNA_WEB_DB' => [
			"DB_DRIVER" => "sqlsrv",
			"DB_HOST" => ".",
			"DB_PORT" => "1433",
			"DB_NAME" => "LunaWeb",
			"DB_USER" => "sa",
			"DB_PASS" => "pass@word1"
		],
	],
	"ERROR_PAGE_500" => 'errors/500',

	"ERROR_PAGE_400" => 'errors/400',

	/*
	 * Directory path for controller files
	 */
	'CONTROLLER_PATH' => APPLICATION_PATH . 'Controllers',
	/*
	 * 
	 */
	'CONTROLLER_NAMESPACE' => 'App\\Controllers',

	/*
	 * Directory path for view files
	 */
	'VIEW_PATH' => APPLICATION_PATH . 'Views',

	/*
	 * Extension for controller file
	 */
	'CONTROLLER_FILE_EXTENSION' => '.php',

	/*
	 * Extension for controller file
	 */
	'VIEW_FILE_EXTENSION' => '.php',

	/*
	 * Example 
	 * Url 			: localhost/Home/Index
	 * Controller 	: HomeController 
	 * Controller class : class HomeController extends Controller {  }
	 */
	'CONTROLLER_PREFIX' => 'Controller',

	/*
	 * Example 
	 * Url 			: localhost/Home/Index
	 * Action 		: IndexAction 
	 * Method 		: function IndexAction() {  }
	 */
	'ACTION_PREFIX' => 'Action'
];


