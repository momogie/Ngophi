<?php

/**
* 
*/
namespace System\Core\Database;
abstract class Queryable 
{
	
	function __construct()
	{
		# code...
	}


	function from($tablename)
	{
		echo $tablename;
	}
}