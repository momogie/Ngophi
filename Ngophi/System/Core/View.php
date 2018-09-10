<?php

namespace System\Core;
use app\Controllers;
class View
{
	
	public static $validationmessage = array();
	function __construct()
	{
		# code...
		/**
		* set default page title 
		* use this in layout page or view page
		* Example : <title><?php $this->Title; ?></title>
		*/
		$this->Title = Config::get('APPLICATION_NAME');
		$this->viewbag = null;

	}

	/**
	* set page title 
	* use this in layout page or view page
	* Example : <title><?php $this->Title; ?></title>
	*/
	function Title($value)
	{
		$this->Title = $value;

		return $this;
	}
	/**
	* Set Layout of page
	* Please Call RenderBody() in your layout page
	* Example : <body><?php $this->RenderBody(); ?></body>
	*/
	function Layout($name)
	{
		$this->Layout = Config::get('VIEW_PATH') .'/'. $name . Config::get('VIEW_FILE_EXTENSION');

		return $this;
	}
	/**
	* Loading views
	* Example : $this->view->Load('directory/filename'); file name is exclude extension
	* in your controller to load view page
	*/
	function Load($name = null,$viewdata =null)
	{

		/**
		* Send data from controller to view page
		* $viewdata is custom variable
		* use $this->viewdata in viewpage
		*/
		if(isset($viewdata)){
			$this->viewdata = $viewdata;
		}

		/**
		* Initializing view page
		*/
		$this->page = $name;
		
		if(!isset($this->Layout)){
			/**
			* Load view with out Layout
			*/
			self::RenderBody();
		}else{
			if(file_exists($this->Layout))
			{			
				require $this->Layout;
			}
		}
		
		return $this;
	}
	/**
	* Load view when using layout
	* if using Layout, please call RenderBody in you layout page
	* Example : <body><div><h1>Hello World!</h1></div><?php $this->RenderBody();?></body>
	*/
	function RenderBody()
	{
		$fileview = Config::get('VIEW_PATH').'/'. $this->page . Config::get('VIEW_FILE_EXTENSION');
		if(file_exists($fileview)){
			require $fileview;
		}else{
			throw new Exception("" . $fileview . ' Does Not Exist.', 1);
		}
	}

	/*
	* Partial view
	* Call another view in one page as partial view
	*
	* you can use this in your view page 
	* to call another page as of Partial view
	* Example : <body><div><h1>Hello World!</h1></div><?php View::Action('Home','Index');?></body>
	*/
	public static  function Action($Controller,$Action,array $data=null,$Directory=null)
	{
		
		$ControllerName = $Controller . Config::get('CONTROLLER_PREFIX');
		$ActionName = $Action . Config::get('ACTION_PREFIX');
		
		$location = Config::get('CONTROLLER_PATH') . (isset($Directory) ? DIRECTORY_SEPARATOR . $Directory  : '');

		if(is_dir($location))
			self::LoadController($location,$ControllerName . Config::get('CONTROLLER_FILE_EXTENSION'));

		$ControllerName = '\\'. Config::get('CONTROLLER_NAMESPACE') .'\\' . $ControllerName;

		if(class_exists($ControllerName))
		{
			$controller = new $ControllerName;

			if(method_exists($ControllerName, $ActionName))
			{
				if(isset($data))
					call_user_func_array(array($controller,$ActionName), $data);
				else
					$controller->{$ActionName}();

				return true;
			}
		}		

		return false;
	}

	static function LoadController($location,$controllerfile) 
	{    
	   foreach (scandir($location) as $key => $value) 
	   { 
	      if (!in_array($value,array(".",".."))) 
	      {
	      	$filename = $location. DIRECTORY_SEPARATOR . $controllerfile;

	      	if(file_exists($filename))
	      	{
	      		require_once($filename);
	      	}
	      	elseif (is_dir($location . DIRECTORY_SEPARATOR . $value)) 
	        {  
	        	$filename = $location . DIRECTORY_SEPARATOR . $value . DIRECTORY_SEPARATOR . $controllerfile ;

	         	if(file_exists($filename))
				{
					require_once($filename);
				}   
	            //else
	            // 	self::LoadController($location . DIRECTORY_SEPARATOR . $value,$controllerfile); 
	        }
	          
	      } 
	   } 
	}
	
	/**
	* this will show json output 
	*/
	public static function JSON($data=null)
	{
		if(isset($data)){
			header("Content-Type: application/json; charset=UTF-8");
			echo json_encode($data);
		}
	}

	public function setValidationMessage($key,$message="")
	{
		self::$validationmessage[$key] = $message;		
	}
	
	public function ValidationMessageFor($key)
	{
		if(isset(self::$validationmessage[$key]) && HTTP_POST)
		{
			echo "<span class='mogh-validation-msg'>" . self::$validationmessage[$key]  . "</span>";
		}
	}
}

if (! function_exists('View')) {
    function View($ViewName, $data = null, $layout=null,$PageTitle=null)
    {
    	$view = new View();
    	
    	if(isset($PageTitle)) $view->Title($PageTitle);
    	if(isset($layout)) $view->Layout($layout);

    	$view->Load($ViewName,$data);
        return $view;
    }
}

if (! function_exists('JsonResult')) {
    function JsonResult($data = null)
    {
    	if(isset($data)){
			header("Content-Type: application/json; charset=UTF-8");
			echo json_encode($data);
		}
		return json_encode($data);
    }
}
