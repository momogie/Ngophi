<?php

/**
 * Ngophi
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    Ngophi
 * @author     Whintz
 * @since      Version Alpha
 * @link	   https://github.com/momogie/Ngophi
 */

header("Server: Apache2");
define('Ngophi_Start',  microtime(TRUE));

// Valid PHP Version?
$php_version_min = '7.0';
if (phpversion() < $php_version_min)
	die("Your PHP version must be {$php_version_min} or higher. Current php version: " . phpversion());

unset($php_version_min);

session_start();

define('PATH', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR);
define('SYSTEM_PATH', realpath(PATH) . DIRECTORY_SEPARATOR . 'System' . DIRECTORY_SEPARATOR);
define('STORAGE_PATH', realpath(PATH) . DIRECTORY_SEPARATOR .'Storage' . DIRECTORY_SEPARATOR);
define('APPLICATION_PATH', realpath(PATH) . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR);

/**
* Get current request method
* @return boolean
*/
define('HTTP_POST', $_SERVER['REQUEST_METHOD'] === 'POST');
define('HTTP_GET', $_SERVER['REQUEST_METHOD'] === 'GET');

/**
* Starting New Application
*/
require_once( SYSTEM_PATH .'Core/Ngophi.php');

System\Core\Ngophi::Run();

defined('Ngophi_End') or define('Ngophi_End',  microtime(TRUE));

/**
* Show time execution
*/

if(Config('DEBUG'))
{
	$time = (Ngophi_End - Ngophi_Start);
	
	$unit=array('b','kb','mb','gb','tb','pb');
	
	echo '<div style="position:fixed;bottom:0;right:0;border-radius:3px;border:solid 1px rgba(0, 0, 0, .2);background:rgba(255,255,255,.9);margin:5px;">';
	echo '<table style="">';
	echo '<tr><th colspan="5" style="border-bottom:solid 1px rgba(0, 0, 0, .2);">Debug Mode ON</th></tr>';
	echo '<tr><td>Server Execution Time  </td><td>:</td><td>'. number_format($time,4) . ' seconds</td></tr>';
	echo '</table>';
	echo '</div>';
}
exit();