<?php
namespace System\Core;
class Router 
{
	private static $routes;
	private static function getRoutes()
	{
		if(!isset(self::$routes))
			self::$routes = require APPLICATION_PATH .'Configs/RouteCollections.php';
		return self::$routes;
	}

	public static function Route()
	{
		foreach (self::getRoutes() as $key => $Routes) 
		{
			preg_match_all("/{(\w+)}/",$Routes['Url'], $default);
			preg_match_all("/{\*(\w+)}/",$Routes['Url'], $custom);

			$pattern = '/^' . str_replace('/', '\/', str_replace($custom[0], '(.+)', str_replace($default[0], '(\w+)', $Routes['Url']))) . '$/';
			
			if(preg_match($pattern,(isset($_GET['url']) ? rtrim($_GET['url'],'/') : ''), $params))
			{
				$Directory 			= null;
				$ControllerName 	= null;
				$ActionName 		= null;

				if(isset($Routes['Options']['Directory']))
				{
					$Directory 		=  ($Routes['Options']['Directory'] == '{Directory}' ? 
											$params[array_search('{Directory}', $default[0]) + 1] : 
												$Routes['Options']['Directory']) ;

					unset($Routes['Options']['Directory']);
				}

				if(isset($Routes['Options']['Controller']))
				{
					$ControllerName = ($Routes['Options']['Controller'] == '{Controller}' ? 
											$params[array_search('{Controller}', $default[0]) + 1] : 
												$Routes['Options']['Controller']) ;

					unset($Routes['Options']['Controller']);
				}

				if(isset($Routes['Options']['Action']))
				{
					$ActionName 	=  ($Routes['Options']['Action'] == '{Action}' ? 
											$params[array_search('{Action}', $default[0]) + 1] : 
												$Routes['Options']['Action']) ;
					
					unset($Routes['Options']['Action']);
				}

				foreach ($Routes['Options'] as $key => $value) 
				{
					if(strpos($value, '{*') !== false)
						$Routes['Options'][$key] = $params[array_search($value, explode('/', $Routes['Url'])) ];
					else
						$Routes['Options'][$key] = ($params[array_search($value, $default[0]) + 1]);
				}

				if(self::Execute($ControllerName,$ActionName,$Routes['Options'],$Directory))
				{
					return;
				}
			}
			
		}

		http_response_code(404);
		$errorpage =  Config::get('VIEW_PATH'). DIRECTORY_SEPARATOR . 'errors/404.php';
		if(file_exists($errorpage))
			include $errorpage;
		else
		{
			echo '<h2 style="color:#555;">Error 404, page not found!</h2>';
		}
		exit();
	}

	public static  function Execute($Controller,$Action,array $data=null,$Directory=null)
	{
	
		$ControllerName = $Controller . Config::get('CONTROLLER_PREFIX');
		$ActionName = $Action . Config::get('ACTION_PREFIX');
		
		$location = Config::get('CONTROLLER_PATH') . (isset($Directory) ? DIRECTORY_SEPARATOR . $Directory  : '');

		$filename =  $ControllerName . Config::get('CONTROLLER_FILE_EXTENSION');
		if(!class_exists($ControllerName))
		{
			if(file_exists($location . DIRECTORY_SEPARATOR . $filename))
			{
				include $location . DIRECTORY_SEPARATOR . $filename;
			}
			// if(in_array($filename, scandir($location)))
			// {	
			//		include $location . DIRECTORY_SEPARATOR . $filename;			
			// }
		}

		if(method_exists($ControllerName, $ActionName))
		{
			$controller = new $ControllerName;
			if(isset($data))
				call_user_func_array(array($controller,$ActionName), $data);
			else
				$controller->{$ActionName}();

			return true;
		}

		return false;
	}

}