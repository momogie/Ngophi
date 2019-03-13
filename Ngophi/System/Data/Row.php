<?php
namespace System\Data;
class Row extends QueryBuilder implements IRow
{
    public static $db;

    function __get($name)
    {
        return $name;
    }
    
    function HasMany($tablename,array $keys)
    {
        foreach ($keys as $key => $value) 
        {
           $keys[$key] = $this->{$value};
        }
        return (new Table($tablename))->Where($keys);
    }
    
    
    function HasOne($tablename,array $keys)
    {
        foreach ($keys as $key => $value) 
        {
           $keys[$key] = $this->{$value};
        }
        return (new Table($tablename))->Where($keys)->first();
    }

    function __toString()
    {
        return __CLASS__;
    }
}