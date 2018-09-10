<?php


/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/momogie/Mogh
*/
namespace System\Core;
class Controller
{	
	
	function __construct()
	{
	}
	function GetInstance()
	{
		$this->post = (object)$_POST;
		
		if(!isset($this->view))
		{
			$this->view = new View();
		}
		if(isset($this->viewbag))
		{			
			$this->viewbag = array();
			$this->view->viewbag = (object)$this->viewbag; 

			unset($this->viewbag);
		}

		return $this->view;
	}

	function Title($name = null)
	{
		self::GetInstance()->Title($name);
	}

	function Layout($name)
	{
		self::GetInstance()->Layout($name);
	}

    
	function View($name,$data = null,$layout=null,$pagetitle =null)
	{
		
		if(isset($pagetitle))
			self::GetInstance()->Title($pagetitle);
		
		if(isset($layout))
			self::GetInstance()->Layout($layout);

		return self::GetInstance()->Load($name,$data);
	}	
	
	function Json($name = null,$data = null)
	{
		self::GetInstance()->JSON($name,$data);
	}
	
	function JsonResult($name = null,$data = null)
	{
		self::GetInstance()->JSON($name,$data);
	}
	
	function CustomValidate($data)
	{
		$valid = true;
		if(HTTP_POST)
		{
			foreach ($data as $key => $value) 
			{
				foreach ($value as $key2 => $value2)
				{
					$validateresult = Validator::Validate($key,$key2,$value2);

					if(!$validateresult['isvalid'])
					{
						$valid = $validateresult['isvalid'];
						self::GetInstance()->setValidationMessage($key, $validateresult['Message']);
						break;
					}
					
				}
				if($valid)
					self::GetInstance()->setValidationMessage($key, null);
			}
		}
		return $valid && HTTP_POST;
	}
	function Validate($data)
	{
		$valid = true;
		if(HTTP_POST)
		{
			foreach ($data as $key => $value) 
			{
				if(!is_array($value))
				{
					foreach (explode('|', $value) as $key2 => $value2)
					{
						$validateresult = Validator::Validate($key,$value2);

						if(!$validateresult['isvalid'])
						{
							$valid = $validateresult['isvalid'];
							self::GetInstance()->setValidationMessage($key, $validateresult['Message']);
							break;
						}
						
					}
				}
				else
				{
					foreach ($value as $key2 => $value2)
					{
						$validateresult = Validator::Validate($key,$key2,$value2);

						if(!$validateresult['isvalid'])
						{
							$valid = $validateresult['isvalid'];
							self::GetInstance()->setValidationMessage($key, $validateresult['Message']);
							break;
						}
						
					}
				}
				
				if($valid)
					self::GetInstance()->setValidationMessage($key, null);
			}
		}
		return $valid && HTTP_POST;
	}

}