<?php
namespace App\Libs;
class dbcontext extends \System\Data\DataContext
{
    protected $config =  [
            "DB_DRIVER" => "mysql",
            "DB_HOST" 	=> "localhost",
            "DB_PORT" 	=> "3306",
            "DB_NAME" 	=> "d",
            "DB_USER" 	=> "root",
            "DB_PASS" 	=> ""
    ];
}