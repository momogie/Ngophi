<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/momogie/Mogh
*/
namespace System\Core;
class HTML
{
	
	function __construct()
	{
		# code...
	}

	/**
	* CSRF Anti cross site attack
	* use this after tag <form >
	* Example : <form action='<?php SELF_ACTION;?>' method='post'><?php AntiForgeryToken();?></form>
	* don't forget to validate AntiForgeryToken in controller
	* use Security::ValidateAntiForgery(); in controller
	*/
	public static function AntiForgeryToken($pageid)
	{
        Session::set('csrf_token_'. $pageid, md5(md5(uniqid(rand(), true)).Config::HASH_KEYS));

        echo '<input type="hidden" value="'. Session::get('csrf_token_'. $pageid) .'" name="__RequestToken" />';
	}
	
	
}