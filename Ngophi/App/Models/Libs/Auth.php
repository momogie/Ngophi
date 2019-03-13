<?php
use System\Core\Session;
class Auth
{
    function __construct()
    {

    }
    static function isSignedIn()
    {

        return self::User() != null;
    }

    static function User()
    {
        return (new dbcontext)->app_users->where('ID', Session::get('__USERID'))->first();
    }
}