<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/momogie/Mogh
*/
if(!function_exists('TextFor'))
{
	function TextFor($name,$value=null,$attributes ='')
	{
		HtmlInputControl($name,$value,$attributes,'text');
	}
}
if(!function_exists('HtmlInputControl'))
{	
	function HtmlInputControl($name,$value=null,$attributes ='',$type='text')
	{
		if(HTTP_POST)
		{
			echo '<input type="'. $type .'" name="'. $name .'" ' . $attributes . ' value="'. $_POST[$name] .'" />' ;
		}else
		{
			if(isset($value))
			{
				echo '<input type="'. $type .'" name="'. $name .'" ' . $attributes . ' value="'. $value .'" />' ;
			}else
			{
				echo '<input type="'. $type .'" name="'. $name .'" ' . $attributes . ' />' ;
			}
		}
	}
}
if(!function_exists('TextAreaFor'))
{
	function TextAreaFor($name,$value=null,$attributes ='')
	{
		echo '<textarea name="'. $name .'" ' . $attributes . '>'. ( (isset($_POST[$name]) ? $_POST[$name] : isset($value) ? $value :  '')) .'</textarea>' ;
	}
}
if(!function_exists('PasswordFor'))
{
	function PasswordFor($name,$value=null,$attributes ='')
	{
		HtmlInputControl($name,$value,$attributes,'password');
	}
}
if(!function_exists('EmailFor'))
{
	function EmailFor($name,$value=null,$attributes ='')
	{
		HtmlInputControl($name,$value,$attributes,'email');
	}
}
if(!function_exists('DropDownListFor'))
{
	function DropDownListFor($name,$value=null,$data,$valuefield,$textfield,$attributes ='')
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
}
if(!function_exists('RadioButtonListFor'))
{
	function RadioButtonListFor($name,$value=null,$data,$valuefield,$textfield,$repeatdirection='vertical',$attributes ='')
	{
		foreach ($data as $key => $val) {
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


if(!function_exists('TableRowAdd'))
{
	function TableRowAdd($data,$Row,string $attr ='')
	{
		foreach ((object)$data as $key => $value) 
		{
			echo '<tr '.  $attr.'>';
			foreach ((object)$Row as $key1 => $value1) {
				echo '<td '. (array_key_exists('1', $value) ? $value1[1] : '') .'>';
				echo $value->{$value1[0]};
				echo '</td>';
			}
			echo '</tr>';
		}
	}
}