<?php


namespace System\Core;

/**
* 
*/

class Router 
{
	
	public static function Execute(array $RoutesCollections)
	{
		foreach ($RoutesCollections as $key => $Routes) 
		{
			preg_match_all("/{(\w+)}/",$Routes['Url'], $default);
			preg_match_all("/{\*(\w+)}/",$Routes['Url'], $custom);

			$pattern = '/^' . str_replace('/', '\/', str_replace($custom[0], '(.+)', str_replace($default[0], '(\w+)', $Routes['Url']))) . '$/';
			if(preg_match($pattern,(isset($_GET['url']) ? rtrim($_GET['url'],'/ ') : ''), $params))
			{
				$Directory 			= null;
				$ControllerName 	= null;
				$ActionName 		= null;

				if(array_key_exists('Directory',$Routes['Options']))
				{
					$Directory 		=  ($Routes['Options']['Directory'] == '{Directory}' ? 
											$params[array_search('{Directory}', $default[0]) + 1] : 
												$Routes['Options']['Directory']) ;

					unset($Routes['Options']['Directory']);
				}

				if(array_key_exists('Controller',$Routes['Options']))
				{
					$ControllerName = ($Routes['Options']['Controller'] == '{Controller}' ? 
											$params[array_search('{Controller}', $default[0]) + 1] : 
												$Routes['Options']['Controller']) ;

					unset($Routes['Options']['Controller']);
				}

				if(array_key_exists('Action',$Routes['Options']))
				{
					$ActionName 	=  ($Routes['Options']['Action'] == '{Action}' ? 
											$params[array_search('{Action}', $default[0]) + 1] : 
												$Routes['Options']['Action']) ;
					
					unset($Routes['Options']['Action']);
				}

				foreach ($Routes['Options'] as $key => $value) 
				{
					if(strpos($value, '{*') !== false)
						$Routes['Options'][$key] = $params[array_search($value, explode('/', $Routes['Url'])) + 1];
					else
						$Routes['Options'][$key] = ($params[array_search($value, $default[0]) + 1]);
				}
				if(View::Action($ControllerName,$ActionName,$Routes['Options'],$Directory))
				{
					return;
				}
			}
			
		}
		//throw new Exception('Request page not found.', 1);

		//new RuntimeError("Request page not found");
	}
	
}