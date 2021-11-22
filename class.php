<?
require 'config.php';
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class FormController
{
    static $mysqli;
    public function __construct()
    {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($mysqli->connect_error) {
            die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }
        self::$mysqli = &$mysqli;
    }
    
    static function delete($id)
    {
        $sql = "DELETE FROM `gaufrus` where `id`=$id";
        $res = self::$mysqli->query($sql);
        $res = ["status"=>$res];
        return json_encode($res);
    }

    static function add($arr, $files)
    {
        $name = $arr['name'];
        $phone = $arr['phone'];
        $email = $arr['email'];
        $files = json_encode($files);
        $sql = "INSERT INTO `gaufrus` (`id`, `name`, `email`, `phone`,`files`) 
        VALUES (NULL,
        '".$name."', 
        '".$phone."', 
        '".$email."',
        '".$files."');";
        $res = self::$mysqli->query($sql);
    }
}