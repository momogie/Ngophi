<?php
namespace System\Data;
class Database extends \PDO implements IDatabase
{
	public $config;
    function __construct(array $config)
	{
		$this->config = $config;
		switch (strtolower($config["DB_DRIVER"])) 
		{
			case 'sqlsrv':
				parent::__construct('sqlsrv:Server='. $config["DB_HOST"] .','. $config["DB_PORT"] .';Database=' . $config["DB_NAME"],$config["DB_USER"],$config["DB_PASS"]);
				break;
			case 'mysql':
				parent::__construct('mysql:host='. $config["DB_HOST"] .';port='.$config["DB_PORT"].';dbname='. $config["DB_NAME"],$config["DB_USER"],$config["DB_PASS"]);
				break;	
			case 'pgsql':
				parent::__construct('pgsql:host='. $config["DB_HOST"] .';port='.$config["DB_PORT"].';dbname='. $config["DB_NAME"],$config["DB_USER"],$config["DB_PASS"]);
				break;	
		}

		$this->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
	}
	
	private function fetchmode()
	{
		if(isset($this->config['FETCH_MODE']))
			switch(strtolower($this->config['FETCH_MODE']))
			{
				case 'array' || 'assoc':
					return \PDO::FETCH_ASSOC;
				case 'object' :
					return \PDO::FETCH_OBJ;
			}
		return \PDO::FETCH_OBJ;
	}

	public function ResultSet($Query)
	{	
		$stmt = $this->prepare($Query);
		$stmt->execute();		
		return $stmt->fetchAll($this->fetchmode());
	}

	public function ResultSetToClass($Query,$ClassName)
	{		
		$stmt = $this->prepare($Query);
		$stmt->execute();		
		return $stmt->fetchAll(\PDO::FETCH_CLASS,$ClassName);
	}	

	public function First($Query)
	{		
		$stmt = $this->prepare($Query);
		$stmt->execute();		
		return $stmt->fetch(\PDO::FETCH_OBJ);
	}

	public function FirstToClass($Query,$ClassName)
	{		
		$stmt = $this->prepare($Query);
		$stmt->execute();	
		$stmt->setFetchMode(\PDO::FETCH_CLASS, $ClassName);	
		return $stmt->fetch();
	}

	public function GetSingle($Query)
	{
		$stmt = $this->prepare($Query);
		$stmt->execute();		
		return $stmt->fetchColumn();
	}

	public function Execute($Query)
	{
		$stmt = $this->prepare($Query);			
		return $stmt->execute();	
	}

	public function ExecuteProcedure($name,array $values)
	{
		$keys = ':' . implode(',:',array_keys($values[0]));
		switch (strtolower($this->config["DB_DRIVER"])) 
		{
			case 'sqlsrv':
				$stmt = $this->prepare('EXEC '. $name . ' ' . $keys);
				return $stmt->execute($values[0]);	
			case 'mysql':
				break;	
		}		
	}

	public static function SqlSafe($str)
	{
		$str = str_replace('\`',"``",$str);
		return str_replace('\'',"''",$str);
	}
    
}