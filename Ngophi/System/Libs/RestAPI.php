<?php

namespace System\Libs;


/**
* 
*/
class RestAPI 
{

	function __construct(string $url,array $config = null)
	{
		$this->Url = $url;
		if(isset($config)) $this->Config = $config;
	}
	function Init()
	{
		$this->Curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $this->Url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => ["cache-control: no-cache"],
		]);
	}
	function Get()
	{

	}
	function Post()
	{

	}
	function Close()
	{

	}
	function ObjResult()
	{

	}
}