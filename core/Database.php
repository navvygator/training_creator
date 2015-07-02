<?php
/**
 * Created by PhpStorm.
 * User: navvygator
 * Date: 28.06.15
 * Time: 14:44
 */
require_once('Settings.php');

class Database {

    private static $_instance=null;
    private $db;

    private $ar_select = null;
    private $ar_where = null;
    private $ar_join = null;
    private $ar_limit = null;
    private $ar_order = null;
    private $ar_set = null;
    private $ar_from = null;
    private $ar_update = null;

    private $query = null;

    private function __construct($host, $name, $user, $pass)
    {

        $this->db = new mysqli($host, $user, $pass, $name);
        if($this->db->connect_error)
        {
            printf("Не удалось подключиться: %s\n", $this->db->connect_error);
            exit();
        }
        $this->db->set_charset("utf8");
    }

    private function __clone()
    {

    }

    public static function getInstance()
    {
        if (self::$_instance===null)
        {
            $settings = Settings::getInstance();
            self::$_instance = new self($settings->db_host(), $settings->db_name(), $settings->db_user(), $settings->db_pass());
        }

        return self::$_instance;
    }

    public function select($select='* ', $limit=FALSE)
    {
        if(is_string($select))
        {
            $select = explode(',', $select);
        }
        foreach($select as $val)
        {
            $this->ar_select[] = $val;
        }
        $this->ar_limit=(int)$limit;
    }

    public function where($field, $condition, $val)
    {
        if(!empty($this->ar_where))
        {
            $this->ar_where[] = "AND ($field $condition '$val')";
        }
        else
        {
            $this->ar_where[] = "($field $condition '$val')";
        }
    }

    public function or_where($field, $condition, $val)
    {
        if(!empty($this->ar_where))
        {
            $this->ar_where[] = "OR ($field $condition '$val')";
        }
        else
        {
            $this->ar_where[] = "($field $condition '$val')";
        }
    }

    public function from($table)
    {
        $this->ar_from = $table;
    }

    public function join_table($table, $condition, $type='')
    {
        if ($type!='')
        {
            $type = strtoupper(trim($type));

            if (!in_array($type, array('LEFT', 'RIGHT', 'INNER', 'OUTER', 'LEFT OUTER', 'RIGHT OUTER')))
            {
                $type='';
            }
            else
            {
                $type.=' ';
            }
        }
        $this->ar_join = $type."JOIN ".$table.' ON '.$condition;
    }

    public function order($field, $direction='')
    {
        if($direction!="")
        {
            $direction = strtoupper(trim($direction));
        }
        $this->ar_order[]="$field $direction";
    }

    public function get_vals($is_row=false)
    {
        $query = "SELECT ";
        if($this->ar_select === null)
        {
            $query.="* ";
        }
        if(is_array($this->ar_select))
        {
            $query .= implode(',', $this->ar_select);
        }
        else
        {
            $query.="* ";
        }
        $query .= "FROM ".$this->ar_from;
        if(!empty($this->ar_join))
        {
            $query.=" $this->ar_join";
        }
        if(!empty($this->ar_where))
        {
            $query.=" WHERE ";
            foreach($this->ar_where as $val)
            {
                $query.=" $val";
            }
        }
        if(!empty($this->ar_order))
        {
            $query.=" ORDER BY ".implode(',', $this->ar_order);
        }
        if(!empty($this->ar_limit))
        {
            $query.=" LIMIT ".$this->ar_limit;
        }

        $result = $this->db->query($query);
        if (!$result) {
            throw new Exception("Database Error [{$this->db->errno}] {$this->db->error}");
        }
        if($result->num_rows>1)
        {
            for ($set = array (); $row = $result->fetch_assoc(); $set[] = $row);
            return $set;
        }
        else
        {
            if($is_row===false)
            {
                $set[] = $result->fetch_assoc();
                return $set;
            }
            else
            {
                return $result->fetch_assoc();
            }

        }

    }

    public function reset_query()
    {
        $this->ar_limit = null;
        $this->ar_order = null;
        $this->ar_select = null;
        $this->ar_where = null;
        $this->ar_join = null;
        $this->ar_from = null;
        $this->ar_set = null;
        $this->ar_update = null;
    }

    function insert($table, $values)
    {
        $query="";
        if(is_array($values))
        {
            foreach($values as &$value)
            {
                $value = "'".$value."'";
            }
            $query.="INSERT INTO ".$table." ";
            $keys = array_keys($values);
            $query.="(".implode(', ', $keys).") VALUES ";
            $query.="(".implode(', ', $values).")";
        }
        $result = $this->db->query($query);
        if (!$result) {
            throw new Exception("Database Error [{$this->db->errno}] {$this->db->error}");
        }
    }

    function last_id()
    {
        return $this->db->insert_id;
    }

    public function set($array, $limit=null)
    {
        $this->ar_set = array();
        if(is_array($array))
        {
            foreach($array as $key=>$val)
            {
                $this->ar_set[].=trim($key)."='".trim($val)."' ";
            }
        }
        $this->ar_limit = $limit;
    }

    public function update_vals($table)
    {
        $query="UPDATE ";
        $query.=$table;
        $query.=" SET ";
        $query.=implode(', ', $this->ar_set);
        if(!empty($this->ar_where))
        {
            $query.="WHERE ";
            foreach($this->ar_where as $val)
            {
                $query.=" $val";
            }
        }
        if(!empty($this->ar_limit))
        {
            $query.="LIMIT ";
            $query.=$this->ar_limit;
        }
        $this->db->query($query);

    }

    public function delete_vals($table)
    {
        if(!empty($this->ar_where))
        {
            $query="DELETE FROM ".$table." WHERE ";
            foreach($this->ar_where as $val)
            {
                $query.=" $val";
            }
            $this->db->query($query);
        }
    }

}