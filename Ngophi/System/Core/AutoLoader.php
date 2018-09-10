<?php

namespace System\Core;

class AutoLoader
{
	
	function __construct()
	{
		spl_autoload_register([$this, 'ClassLoader']);
	}
	public function ClassLoader( $class )
    {    

    	$class = str_replace('\\', '/', $class);
	    if( class_exists( $class, false ))
	     	return true;

	    if( is_readable(PATH .$class . '.php' ))
	         require_once PATH . $class . '.php';
    }
}