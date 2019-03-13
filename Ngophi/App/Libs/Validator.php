<?php
namespace App\Libs;
class Validator 
{
    static function UserAvailable($key)
    {
        return !(new dbcontext)->users
        ->where("mobilephone = '". \System\Database\Database::SqlSafe($_POST[$key]) ."' or email  = '". \System\Database\Database::SqlSafe($_POST[$key]) ."'")->Any();
    }
    static function UserExists($key)
    {
        return (new dbcontext)->users
        ->where("email", \System\Database\Database::SqlSafe($_POST[$key]))->Any();
    }
}