<?php 
class HomeController extends System\Core\Controller
{
	function __construct()
	{
		$this->db = new App\Libs\dbcontext();
	}
	
	function indexAction()
	{
		
		return View('home/index',null,'layout.main');
	}
	

}
