<?php

if(!function_exists('UrlFor'))
{
	function UrlFor($value = null,$return = false)
	{
		if(!$return)
		{
			echo System\Core\Config::get('BASE_URL') ;
			echo $value;
		}else{
			return System\Core\Config::get('BASE_URL') . $value;
		}
	}

}

if(!function_exists('ToArray'))
{
	function toArray($data)
	{
		return !isset($data) ? [] : json_decode(json_encode($data),true);
	}
}
if(!function_exists('Any'))
{
	function Any($data)
	{
		return count($data) > 0;
	}
}
if(!function_exists('ToBytes'))
{
	function ToBytes($data)
	{
		$temp = unpack('H*', $data);
		return strtoupper(array_shift($temp));
	}
}
if(!function_exists('__each'))
{
	function __each($data,$callback)
	{
		if(is_array($data))
		{
			$i=0;
	        foreach ($data as $key => $value) 
	        {
	            call_user_func_array($callback, [$value,$key,$i++]);
	        }
		}
	}
}
if(!function_exists('get_func_argNames'))
{
	function get_func_argNames($name) {
	    $f = new ReflectionFunction($name);
	    $result = array();
	    foreach ($f->getParameters() as $param) {
	        $result[] = $param->name;   
	    }
	    return $result;
	}
}
