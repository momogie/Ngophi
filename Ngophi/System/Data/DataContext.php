<?php
namespace System\Data;
abstract class DataContext extends QueryBuilder implements IDataContext
{
    public static $db;
    protected $config;
    public $tables;
    function Init()
    {
        self::$db = QueryBuilder::$db = Table::$db = Row::$db = new Database($this->config);
    }

    function __call($name, $arguments)
    {
        $this->Init();
        return self::$db->ExecuteProcedure($name,$arguments);
    }

    function __get($name)
    {
        $this->Init();

        if(strtolower($name) == 'tables' && $this->config['DB_DRIVER'] == 'sqlsrv')
        {
            $d = new self();
            foreach ((new Table('INFORMATION_SCHEMA.TABLES'))->All() as $key => $value) 
            {
                if(!isset($d->tables[$value->TABLE_NAME]))
                {
                    $d->$tables[$value->TABLE_NAME] = new Table($value->TABLE_NAME);
                }
            }
            return $d->$tables;
        }
        if(!isset($this->tables[$name]))
        {
            $this->tables[$name] = new Table($name);
            $this->tables[$name]->config($this->config, true);
        }    
        return $this->tables[$name];

    }
}