<?php


/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/momogie/Mogh
*/
namespace System\Core;
class Database extends PDO
{
	function __construct(array $config)
	{
		switch (strtolower($config["DB_DRIVER"])) 
		{
			case 'sqlsrv':
				parent::__construct('sqlsrv:Server='. $config["DB_HOST"] .','. $config["DB_PORT"] .';Database=' . $config["DB_NAME"],$config["DB_USER"],$config["DB_PASS"]);
				break;
			case 'mysql':
				parent::__construct('mysql:host='. $config["DB_HOST"] .';port='.$config["DB_PORT"].';dbname='. $config["DB_NAME"],$config["DB_USER"],$config["DB_PASS"]);
				break;	
		}

		$this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	public function ResultSet($Query)
	{		
		$rs = $this->prepare($Query);
		$rs->execute();		
		return $rs->fetchAll(PDO::FETCH_OBJ);
	}
	public function ResultSetToClass($Query,$ClassName)
	{		
		$rs = $this->prepare($Query);
		$rs->execute();		
		return $rs->fetchAll(PDO::FETCH_CLASS,$ClassName);
	}	
	public function First($Query)
	{		
		$rs = $this->prepare($Query);
		$rs->execute();		
		return $rs->fetch(PDO::FETCH_OBJ);
	}
	public function FirstToClass($Query,$ClassName)
	{		
		$rs = $this->prepare($Query);
		$rs->execute();		
		return $rs->fetch(PDO::FETCH_CLASS,$ClassName);
	}
	public function GetSingle($Query)
	{
		$rs = $this->prepare($Query);
		$rs->execute();		
		return $rs->fetchColumn();
	}
	public function Execute($Query)
	{
		$rs = $this->prepare($Query);			
		return $rs->execute();	
	}
	
}

