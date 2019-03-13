<?php
namespace App\Libs;
class akr extends \System\Data\DataContext
{
    protected $config =  [
            "DB_DRIVER" => "sqlsrv",
            "DB_HOST" 	=> ".",
            "DB_PORT" 	=> "1433",
            "DB_NAME" 	=> "Morph",
            "DB_USER" 	=> "sa",
            "DB_PASS" 	=> "pass@word1"
    ];
    


}