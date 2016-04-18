<?php

class DataBase
{

    private $dbhost = 'localhost';
    private $dbname = 'notebook_database';
    private $dbuser = 'root';
    private $dbpass = '';

    private static $db = null;
    private $mysqli;
    private $sym_query = "{?}";

    public static function getDB()
    {
        if (self::$db == null) self::$db = new DataBase();
        return self::$db;
    }

    private function __construct()
    {
        $this->mysqli = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        $this->mysqli->query("SET lc_time_names = 'uk_UA'");
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    private function getQuery($query, $params)
    {
        if ($params) {
            for ($i = 0; $i < count($params); $i++) {
                $pos = strpos($query, $this->sym_query);
                $arg = "'" . $this->mysqli->real_escape_string($params[$i]) . "'";
                $query = substr_replace($query, $arg, $pos, strlen($this->sym_query));
            }
        }
        return $query;
    }

    public function select($query, $params = false)
    {
        $result_set = $this->mysqli->query($this->getQuery($query, $params));
        if (!$result_set) return false;
        return $this->resultSetToArray($result_set);
    }

    public function selectRow($query, $params = false)
    {
        $result_set = $this->mysqli->query($this->getQuery($query, $params));
        if ($result_set->num_rows != 1) return false;
        else return $result_set->fetch_assoc();
    }

    public function selectCell($query, $params = false)
    {
        $result_set = $this->mysqli->query($this->getQuery($query, $params));
        if ((!$result_set) || ($result_set->num_rows != 1)) return false;
        else {
            $arr = array_values($result_set->fetch_assoc());
            return $arr[0];
        }
    }

    public function query($query, $params = false)
    {
        $success = $this->mysqli->query($this->getQuery($query, $params));
        if ($success) {
            if ($this->mysqli->insert_id === 0) return true;
            else return $this->mysqli->insert_id;
        } else return false;
    }

    function get_tables()
    {
        $tableList = array();
        $res = mysqli_query($this->mysqli, "SHOW TABLES");
        while ($cRow = mysqli_fetch_array($res)) {
            $tableList[] = $cRow[0];
        }
        return $tableList;
    }

    function real_escape_string($var)
    {
        return $this->mysqli->real_escape_string($var);
    }

    private function resultSetToArray($result_set)
    {
        $array = array();
        while (($row = $result_set->fetch_assoc()) != false) {
            $array[] = $row;
        }
        return $array;
    }

    public function __destruct()
    {
        if ($this->mysqli) $this->mysqli->close();
    }
}

?>