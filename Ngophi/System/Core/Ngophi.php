<?php
namespace System\Core;

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
 * @filesource
 */

class Ngophi
{
	public static function Run()
	{
		require_once('AutoLoader.php');
		
		new AutoLoader();

        set_exception_handler('System\Core\Exception\RuntimeException::Exception');
		//set_error_handler('System\Core\ErrorHandler::Error', error_reporting());
		register_shutdown_function('System\Core\Exception\RuntimeException::Error');

		if(Config::get('DEBUG')) 
			error_reporting(2);
		require_once(SYSTEM_PATH . 'Core/global/Helper.php');
		require_once(SYSTEM_PATH . 'Core/global/View.php');

		
		date_default_timezone_set(Config::get('DEFAULT_TIMEZONE'));

		
		Security\SQLInjectionDetector::Run();
		Router::Route();
	}
	
}