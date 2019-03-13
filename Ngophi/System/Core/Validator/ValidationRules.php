<?php
namespace System\Core\Validator;
use System\Core\Language as Lang;
class ValidationRules
{

    public static function required($key, $custom_message = null)
    {
        if(empty($_POST[$key]))
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('required'), $key)
            ];
        }
        return;
    }


    public static function alpha($key, $custom_message = null)
    {
        if(ctype_alpha($_POST[$key]))
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('alpha'), $key)
            ];
        }
        return;
    }


    public static function alpha_numeric($key, $custom_message = null)
    {
        if(ctype_alnum($_POST[$key]))
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('alpha_numeric'), $key)
            ];
        }
        return;
    }


    public static function numeric($key, $custom_message = null)
    {
        if(is_numeric($_POST[$key]))
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('numeric'), $key)
            ];
        }
        return ;
    }


    public static function decimal($key, $custom_message = null)
    {
        if((bool) preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $_POST[$key]))
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('decimal'), $key)
            ];
        }
        return ;
    }


    public static function integer($key, $custom_message = null)
    {
        if((bool) preg_match('/^[\-+]?[0-9]+$/', $_POST[$key]))
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('integer'), $key)
            ];
        }
        return ;
    }


    public static function email($key, $custom_message = null)
    {
        if(!filter_var($_POST[$key], FILTER_VALIDATE_EMAIL))
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('email'), $key)
            ];
        }
        return ;
    }
    

    public static function length($key, $count, $custom_message = null)
    {
        if(strlen($_POST[$key]) != $count)
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('length'), $key, $count)
            ];
        }
        return ;
    }
    

    public static function min($key, $count, $custom_message = null)
    {
        if(strlen($_POST[$key]) < $count)
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('min'), $key, $count)
            ];
        }
        return;
    }
    

    public static function max($key, $count, $custom_message = null)
    {
        if(strlen($_POST[$key]) > $count)
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('max'), $key, $count)
            ];
        }
        return;
    }
    

    public static function match($key, $match, $custom_message = null)
    {
        if($_POST[$key] !=  $_POST[$match])
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('match'), $key, $match)
            ];
        }
        return;
    }
    

    public static function phone($key, $custom_message = null)
    {
        if(!(bool) preg_match('/^[\+]?[0-9]+$/', $_POST[$key]))
        {
            return [
                'valid' => false,
                'message'   => isset($custom_message) ? $custom_message : sprintf(Lang::validation('phone'), $key)
            ];
        }
        return ;
    }
    

}