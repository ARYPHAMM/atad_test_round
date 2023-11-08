<?php
if (!defined('_lib')) die("Error");
class database
{
	private $db;
	private $result;
	private $insert_id;
	private $sql = "";
	private $refix = "";
	private $servername;
	private $username;
	private $password;
	private $database;
	private $port;
	private $table = "";
	private $condition = "";
	private $error = array();
	function __construct($config = array())
	{
		if (!empty($config)) {
			
			$this->init($config);
			$this->connect();
		}
	}
	function init($config = array())
	{
		foreach ($config as $k => $v) {
			$this->{$k} = $v;
		}
		// $this->$k = $v;
	}
	function connect()
	{
		$this->db =  mysqli_connect($this->servername, $this->username, $this->password, $this->database,$this->port);
	
		if ($this->db->connect_error) {
			die("Connection failed: " . $this->db->connect_error);
		}
		$this->db->set_charset("utf8");
	}
	function query($sql = "")
	{
		if (!empty($sql))
			$this->sql = str_replace('#_', $this->refix, $sql);
		$this->result = $this->db->query($this->sql);
		if (!$this->result) {
			die("syntax error: " . $this->sql);
		}
		return $this->result;
	}
	function insert($data = array())
	{
		if (!empty($data) || !empty($this->table)) {
			$keys = array_keys($data);
			$values = array();
			foreach ($data as $value) {
				$item = array();
				foreach ($keys as  $value_k) {
					$item[] =  mysqli_real_escape_string($this->db, $data[$value_k]);
				}
			}
			$values = "('" . implode("','", $item) . "')";
			$keys = '( ' . "`" . implode("`,`", $keys) . "`" . ')';
			$sql = "insert into {$this->refix}{$this->table} {$keys} values {$values};";
			if ($this->db->query($sql)) {
				return true;
			} else {
				return false;
			}
		} else {
			die(1);
		}
	}
	function update($data = array())
	{
		if (!empty($data) || !empty($this->table)) {
			$keys = array_keys($data);
			$values = array();
			foreach ($data as $value) {
				$item = array();
				foreach ($keys as  $value_k) {
					$item[] =  "`{$value_k}` = '" . ($data[$value_k]) . "'";
				}
			}
			$values = implode(",", $item);
			$sql = "update {$this->refix}{$this->table} set {$values} {$this->condition}";
			if ($this->db->query($sql)) {
				return true;
			} else {
				return false;
			}
		} else {
			die(1);
		}
	}
	function delete()
	{
		$this->sql = "delete from " . $this->refix . $this->table . " " . $this->condition;
		return $this->query();
	}
	function select($str = "*")
	{
		$this->sql = "select " . $str;
		$this->sql .= " from " . $this->refix . $this->table;
		$this->sql .= " " . $this->condition;
		return $this->query();
	}
	function num_rows()
	{
		return mysqli_num_rows($this->result);
	}
	function fetch_array()
	{
		return $this->result->fetch_array(MYSQLI_ASSOC);
	}
	function result_array()
	{
		$row = array();
		while (true) {
			$item =  $this->result->fetch_array(MYSQLI_ASSOC);
			if (!empty($item)) {
				$row[] = $item;
			} else {
				break;
			}
		}
		return  empty($row) ==  true ? false : $row;
	}
	function setTable($tbl)
	{
		$this->table = str_replace($this->refix, "", $tbl);
	}
	function setCondition($condition = "")
	{
		$this->condition = $condition;
	}
	function getMaxId($table)
	{
		$this->query(sprintf("select max(id) as maxid from #_%s", $table));
		$result = $this->fetch_array();
		if (in_array(@$result['maxid'], array(0, "0", "", NULL)))
			return 1;
		return intval($result['maxid']) + 1;
	}
}
