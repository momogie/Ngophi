<?php
namespace System\Data;
class Table extends QueryBuilder implements ITable
{
    public static $db;
    public $name;
    function __construct($name)
    {
        $this->build('table', $name, true);
        $this->name = $name;
    }

    public function __toString()
    {
        return __CLASS__;
    }
}