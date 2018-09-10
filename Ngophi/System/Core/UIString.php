<?php

/**
 * 
 */

namespace System\Core;

class UIString 
{

	public static function getMsg($MID,$LID)
	{
		$Lang = (require APPLICATION_PATH .'Config/UIString.php');
		return  !array_key_exists($MID,$Lang) 
				? $MID : !array_key_exists($LID,$Lang[$MID])  
				? $MID : $Lang[$MID][$LID];
	}
}