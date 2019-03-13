<?php
namespace System\Core;

class AutoLoader
{
	private static $list = null;
	function __construct()
	{
		spl_autoload_register([$this, 'ClassLoader']);
	}
	public function ClassLoader($class)
	{
		$filename = PATH . str_replace('\\', '/', $class) . '.php';
		if (file_exists($filename)) 
		{
			include $filename;
			return;
		}
		
		if(!class_exists($class))
		{
			if(isset(self::getList()[$class]))
			{
				include_once PATH . self::getList()[$class];
				
				if(preg_match("/[\s]*(System)/i",self::getList()[$class]))
				{
					class_alias('System\\Core\\'. $class , $class);
				}
				return;
			}
		}
		
	}

	private static function getList()
	{
		if(self::$list === null)
		{
			self::$list = (require APPLICATION_PATH . 'Configs'. DIRECTORY_SEPARATOR .'AutoLoader.php');
		}

		return self::$list;
	}
	
	
}