<?php 
namespace app\Controllers;

use System\Core\Database\DataContext;
use app\Libs\API\Sealgame;

class HomeController extends \System\Core\Controller
{
	function __construct()
	{

	}
//
	function IndexAction()
	{
		print json_decode(Sealgame::get());

		//echo 'test';
		//return $this->View('Index');
	}

	function ApiAction()
	{
		return $this->JsonResult([
			'ID'	=> 123155,
			'Name'	=> 'Whintz'
		]);
	}
}
