<?php
if (!defined('_lib')) die("Error");
$http = "http://";
if ($_SERVER['HTTPS'] == "on")
	$http = "https://";
$config_url = $http . $_SERVER["SERVER_NAME"];
if (count(explode("//", $_SERVER['REQUEST_URI'])) > 1)
	header("Location: " . preg_replace('/\/+/i', '/', $_SERVER['REQUEST_URI']));
if (count(explode($http . "www.", $config_url)) > 1) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: " . $http . str_replace($http . "www.", "", $config_url));
	exit(1);
}
$config['database']['servername'] = 'mysql';
$config['database']['username'] = 'root';
$config['database']['database'] = 'atad_db';
$config['database']['password'] = 'password';
$config['database']['port'] = '3306';
$config['database']['refix'] = '';
