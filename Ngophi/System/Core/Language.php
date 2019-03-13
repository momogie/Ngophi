<?php

namespace System\Core;

class Language 
{
    public static function validation($key)
    {
        $messages = require  SYSTEM_PATH . 'Language'  . DIRECTORY_SEPARATOR . Config::get('APP_LANGUAGE') . DIRECTORY_SEPARATOR . 'validation.php';
        if(isset($messages[$key]))
        {
            return $messages[$key];
        }
        throw new \Exception('Validation message for "'. $key .'" not available' , 1    );
    }
}




