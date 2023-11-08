<?php
if (!defined('_lib')) die("Error");
function alert($s)
{
	echo '<meta charset="utf-8"><script language="javascript"> alert("' . $s . '") </script>';
}
function back($n = 1)
{
	echo '<script language="javascript">history.go("' . -intval($n) . '");</script>';
	exit(1);
}
function delete_file($file)
{
	return @unlink(realpath("../" . $file));
}
function redirect($url = '')
{
	echo '<script language="javascript">window.location = "' . $url . '" </script>';
	exit(1);
}
function show_error()
{
	"Có lỗi xảy ra";
}
function getItems($sql = "")
{
	global $db;
	$db->query($sql);
	if ($db->num_rows() == 0)
		return false;
	return $db->result_array();
}
function getItem($sql = "")
{
	global $db;
	$db->query($sql);
	if ($db->num_rows() == 0)
		return false;
	return $db->fetch_array();
}
function removeItem($sql = "")
{
	global $db;
	if ($db->query($sql) === TRUE)
		return true;
	return false;
}
function saveItem($args = array())
{
	global $db;
	$options = array("table" => false, "data" => array(), "condition" => "", "affix" => "", "insert" => false);
	foreach ($args as $key => $value)
		$options[$key] = $value;
	if ($options['table'] === false)
		return false;
	if ($options['affix'] != "")
		$options['affix'] = "_" . $options['affix'];
	$item = array();
	foreach ($options['data'] as $index) {
		$item[$index] = trim($_POST[$index . $options['affix']]);
	}
	$db->setTable($options['table']);
	if ($options['insert'] === false && $options['condition'] != "") {
		$db->setCondition($options['condition']);
		$db->select();
		if ($db->num_rows() == 0) {
			$item["id"] = $db->getMaxId($options['table']);
			$db->setCondition();
			return $db->insert($item);
		}
		return $db->update($item);
	} else {
		if ($_POST["id{$options['affix']}"] != "" && $options['table'] != "translate")
			$item["id"] = $_POST["id{$options['affix']}"];
		else
			$item["id"] = $db->getMaxId($options['table']);
		$db->setCondition();
		return $db->insert($item);
	}
}
