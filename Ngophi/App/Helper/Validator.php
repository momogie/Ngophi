<?php
namespace App\Helper;
class Validator 
{
    public static function isEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    public static function isMobilePhone($value)
    {
        return preg_match('/^[\+]?[0-9]+$/', $value);
    }
}