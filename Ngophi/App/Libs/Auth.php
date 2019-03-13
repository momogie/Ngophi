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
        Session::set('__USERID', 1);
        return (new App\Libs\dbcontext)->users->where('ID', Session::get('__USERID'))->first();
    }
}