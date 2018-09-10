<?php
/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/momogie/Ngophi
*/

define('PATH', '../');
define('SYSTEM_PATH', '../System/');
define('STORAGE_PATH', __DIR__. '/../Storage/');
define('APPLICATION_PATH', '../app/');
/**
* Capture start time of execution
*/

define('Ngophi_Start',  microtime(TRUE));

/**
* Starting New Application
*/
require_once( SYSTEM_PATH .'core/Ngophi.php');
new System\Core\Ngophi();

