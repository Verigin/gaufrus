<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set("max_execution_time","3000");
ini_set("memory_limit","4096M");
define('DB_HOST', 'localhost');
define('DB_USER', 'baltaz19_test1');
define('DB_PASSWORD', '%GxYs2G3');
define('DB_NAME', 'baltaz19_test1');
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}