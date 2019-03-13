<?php
namespace System\Core;
class HTML
{
	
	function __construct()
	{
		# code...
	}

    /* ===================================================================================== */

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
	
	public static function Action($Controller,$Action,array $data=null,$Directory=null)
	{
		
		return Router::Execute($Controller, $Action, $data, $Directory);
	}
	
	public static function TextFor($name,$value=null,$attributes ='')
	{
		self::HtmlInputControl($name,$value,$attributes,'text');
	}

	public static function HtmlInputControl($name,$value=null,$attributes ='',$type='text')
	{
		if(HTTP_POST)
		{
			echo '<input type="'. $type .'" name="'. $name .'" ' . $attributes . ' value="'. (array_key_exists($name, $_POST) ? $_POST[$name] : '') .'" />' ;
		}else
		{
			if(isset($value))
			{
				echo '<input type="'. $type .'" name="'. $name .'" ' . $attributes . ' value="'. $value .'" />' ;
			}
			else
			{
				echo '<input type="'. $type .'" name="'. $name .'" ' . $attributes . ' />' ;
			}
		}
	}
	
	public static function TextAreaFor($name,$value=null,$attributes ='')
	{
		echo '<textarea name="'. $name .'" ' . $attributes . '>'. ( (isset($_POST[$name]) ? $_POST[$name] : isset($value) ? $value :  '')) .'</textarea>' ;
	}

	public static function PasswordFor($name,$value=null,$attributes ='')
	{
		self::HtmlInputControl($name,$value,$attributes,'password');
	}

	public static function EmailFor($name,$value=null,$attributes ='')
	{
		self::HtmlInputControl($name,$value,$attributes,'email');
	}
	
	public static function RadioButtonFor($name,$value=null,$attributes ='')
	{
		self::HtmlInputControl($name,$value,$attributes,'radio');
	}
	
	public static function DropDownListFor($name,$value=null,$data,$valuefield,$textfield,$attributes ='')
	{
		echo '<select name="'. $name .'" '. $attributes .'>';
		foreach ($data as $key => $val) {
			# code...
			if(HTTP_POST)
			{
				if($_POST[$name] == $val[$valuefield])
				{
					echo '<option value="'. $val[$valuefield] .'" selected>'. $val[$textfield] .'</option>';
				}else
				{
					echo '<option value="'. $val[$valuefield] .'">'. $val[$textfield] .'</option>';
				}
			}elseif(isset($value))
			{
				if($value == $val[$valuefield])
				{
					echo '<option value="'. $val[$valuefield] .'" selected>'. $val[$textfield] .'</option>';
				}else
				{
					echo '<option value="'. $val[$valuefield] .'">'. $val[$textfield] .'</option>';
				}
			}else
			{
				echo '<option value="'. $val[$valuefield] .'">'. $val[$textfield] .'</option>';
			}
		}
		echo '</select>';
	}

	public static function RadioButtonListFor($name,$value=null,$data,$valuefield,$textfield,$repeatdirection='vertical',$attributes ='')
	{
		foreach ($data as $key => $val) 
		{
			# code...
			if(HTTP_POST)
			{
				if($_POST[$name] == $val[$valuefield])
				{
					echo '<input type="radio" name="'. $name .'" value="'. $val[$valuefield] .'" checked="checked" /> '. $val[$textfield] ;

				}else
				{
					echo '<input type="radio" name="'. $name .'" value="'. $val[$valuefield] .'" /> '. $val[$textfield];
				}
			}elseif(isset($value))
			{
				if($value == $val[$valuefield])
				{
					echo '<input type="radio" name="'. $name .'" value="'. $val[$valuefield] .'" checked="checked" /> '. $val[$textfield] ;
				}else
				{
					echo '<input type="radio" name="'. $name .'" value="'. $val[$valuefield] .'" /> '. $val[$textfield] ;
				}
			}else
			{
				echo '<input type="radio" name="'. $name .'" value="'. $val[$valuefield] .'" /> '. $val[$textfield] ;
			}
			echo (strtolower($repeatdirection) == 'vertical' ? '<br />' : '');
		}
	}
	
}