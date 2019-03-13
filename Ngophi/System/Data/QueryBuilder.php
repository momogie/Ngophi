<?php
namespace System\Data;
abstract class QueryBuilder implements IQueryBuilder
{
    public static $db;

    public function config($object = null, bool $reset = false)
    {
        static $config;
        if(is_string($object))
        {
            return $config[$object];
        }
        if(($reset || $config == null) && is_array($object) )
        {
            $config = $object;
        }
        return $config;
    }

    public function build(string $key = null, string $value = null,bool $reset = false)
    {
        static $query;
        if($reset || $query == null)
        {
            $query =[
                'declare'       => '',
                'statement'     => '',
                'clause'        => '',
                'table'         => '',
                'join'          => '',
                'where'         => ' WHERE 1=1 ',
                'clause2'       => '',
                'groupby'       => '',
                'orderby'       => '',
                'offset'        => '',
                'statement'     => ''
            ];
        }
        if($key != null && $value !== null)
        {
            switch($key)
            {
                case 'join':
                case 'where':
                    $query[$key] .= $value;
                    break;
                default:
                    $query[$key] = $value;
                    break;
            }
            if($key == 'where' && $value == '')
            {
                $query[$key] = '';
            }
        }

        if($value == null && $key != null)
        {
            return $query[$key];
        }
        return implode(" ",  $query);
    }

    public function from(string $tablename,string $alias = '')
    {
        $this->build('table',$tablename . ' ' . $alias);

        return $this; 
    }

    public function declare($name,$data_type = 'varchar(100)' , $value = '')
    {
        $this->query['declare'] .= 'declare @' . $name . ' ' . $data_type .' = ' . '('. $value .');';

        return $this;
    }

    public function join(string $from,string $alias = '')
    {
        $this->build('join',' JOIN ' . $from .' ' . $alias);

        return $this;
    }

    public function leftjoin(string $from,string $alias = '')
    {
        $this->build('join','LEFT JOIN ' . $from .' ' . $alias);
        return $this;
    }

    public function rightjoin(string $from,string $alias = '')
    {
        $this->build('join','RIGHT JOIN ' . $from .' ' . $alias);
        return $this;
    }

    public function fulljoin(string $from,string $alias = '')
    {
        $this->build('join','FULL OUTER JOIN ' . $from .' ' . $alias);
        return $this;
    }

    public function on($key1,$key2=null)
    {
        
        if(isset($key1) && isset($key2)) 
        {
            $this->build('join', ' ON ' . $key1 . ' = ' . $key2);
        }
        
        if(isset($key1) && !isset($key2))
        {
            $this->build('join', ' ON ' .implode(' AND ', 
                array_map(
                    function ($v, $k) { return sprintf("%s = %s" ,$k, $v); },
                        $key1,
                        array_keys($key1)
                    )
                )
            );
           
        }   
     
        return $this;
    }

    public function where($w1,$w2=null,$w3=null)
    {
        if(isset($w1) && isset($w2) && isset($w3)) 
        {
            $this->build('where', ' AND ' . $w1 . ' ' . $w2 . ' ' . "'". Database::SqlSafe($w3) ."'");
        }

        if(isset($w1) && isset($w2) && !isset($w3))
        {
            $this->build('where', ' AND ' . $w1 . ' = ' . "'". Database::SqlSafe($w2) ."'");
        }

        if(isset($w1) && !isset($w2)&& !isset($w3))
        {
            if(is_array($w1) && !array_key_exists(0,$w1))
            {
                $this->build('where', ' AND ' . implode(' and ', 
                    array_map(
                        function ($v, $k) { return sprintf("%s = '%s'" ,$k,  Database::SqlSafe($v)); },
                        $w1,
                        array_keys($w1)
                    ))
                );
            }
            else
            {
                $this->build('where', ' AND ' . $w1);
            }
        }   
        return $this;
    }

    public function groupby(string $groupby)
    {
        $this->build('groupby', ' GROUP BY ' . $groupby);
        return $this;
    }

    public function orderby(string $orderby,string $order = 'ASC')
    {
        $this->build('orderby',  ' ORDER BY ' . $orderby .' '. $order);
        return $this;
    }

    public function ordernext(string $orderby,string $order = 'ASC')
    {
        //$this->query['orderby'] .= ' ,' . $orderby .' '. $order;
        return $this;
    }

    public function All()
    {
        $this->build('statement',  'SELECT ' . $this->build('clause') . ' * FROM ');
        $this->build('clause','') ;
        return self::$db->ResultSetToClass($this->build(), __NAMESPACE__ . '\\' . 'Row');
    }

    public function get($data=null,$count = null)
    {
        $select='*';
        if (isset($data))
        {
            if (is_array($data) && !array_key_exists(0,$data))
            {
                $select = implode(', ', array_map(
                    function ($v, $k) { return sprintf("%s as %s", $v ,$k); },
                    $data,
                    array_keys($data)
                ));
            }
            elseif (is_array($data)) 
            {
                $select = implode(' , ', $data);
            }
            elseif (isset($data))
            {
                $select = $data;
            }
        
        }    
        
        if(is_numeric($count)) 
        {
            $this->Take($count);
        }

        $this->build('statement', 'SELECT ' . $this->build('clause') . $select .' FROM ');
        $this->build('clause','') ;
        return $this;
    }

    public function each($callback,$count = 0)
    {
        $this->get();
        
        $result = self::$db->ResultSetToClass($this->build(), __NAMESPACE__ . '\\' . 'Row');
        $i = 0;

        foreach ($result as $key => $value)  
        {
            if($count > 0 && $i == $count) break;
            
            call_user_func_array($callback, [$value,$key]);

            $i++;
        }
    }

    public function select($data=null)
    {
        $this->get($data);
        return self::$db->ResultSetToClass($this->build(), __NAMESPACE__ . '\\' . 'Row');
    }

    public function first($data=null)
    {
        $this->get($data);
        return self::$db->FirstToClass($this->build(), __NAMESPACE__ . '\\' . 'Row');
    }

    public function take(int $count=0)
    {
        switch(strtolower($this->config('DB_DRIVER')))
        {
            case 'sqlsrv':
                $this->build('clause', 'TOP ' . $count);
                break;
            case 'mysql':
                $this->build('clause2',  'LIMIT ' . $count);
                break;
            case 'oci':
                $this->build('clause2',  'WHERE ROWNUM <= ' . $count);
                break;
        }
        return $this;
    }

    public function count(string $columnname ='*')
    {
        $this->build('statement', 'SELECT COUNT(' . $columnname . ') FROM');
        return self::$db->GetSingle($this->build());
    }

    public function Any()
    {
        $this->build('statement', 'SELECT COUNT(*) FROM ');
        return self::$db->GetSingle($this->build()) > 0;
    }

    public function distinct(string $columnname ='0')
    {
        $this->build('statement', 'SELECT DISTINCT(' . $columnname . ') FROM');
        return self::$db->ResultSet($this->build());
    }

    public function average(string $columnname ='0')
    {
        $this->build('statement', 'SELECT AVG(' . $columnname . ') FROM');
        return self::$db->GetSingle($this->build());
    }

    public function min(string $columnname ='0')
    {
        $this->build('statement', 'SELECT MIN(' . $columnname . ') FROM');
        return self::$db->GetSingle($this->build());
    }

    public function max(string $columnname ='0')
    {
        $this->build('statement', 'SELECT MAX(' . $columnname . ') FROM');
        return self::$db->GetSingle($this->build());
    }

    public function sum(string $columnname ='0')
    {
        $this->build('statement', 'SELECT ISNULL(sum(' . $columnname . '),0) FROM');
        return self::$db->GetSingle($this->build());
    }

    public function delete()
    {
        $this->build('statement', 'DELETE FROM ');
        $stmt = self::$db->prepare($this->build());
        return $stmt->execute();
    }

    public function insert(array $data)
    {
        $this->build('statement', 'INSERT INTO ' . $this->build('table') . ' ( '. implode(' , ', array_keys($data)) .' ) VALUES (:' .implode(', :', array_keys($data)). ')');
        $this->build('table','') ;
        $this->build('where','') ;

        $stmt = self::$db->prepare($this->build());
       
        return $stmt->execute($data);
    }

    public function update(array $data)
    {
        $statement = 'UPDATE '. $this->build('table')  .' SET ';


        $statement .= implode(', ', array_map(
                                function ($v, $k) { return sprintf("%s = :%s",$k ,$k); },
                                $data,
                                array_keys($data)
                            ));

        $this->build('statement', $statement);
        $this->build('table','') ;
        
        $stmt = self::$db->prepare($this->build());
                        
        return $stmt->execute($data);
    }

    public function execute($query)
    {
        $stmt = self::$db->prepare($query);

        return $stmt->execute();
    }
  
}