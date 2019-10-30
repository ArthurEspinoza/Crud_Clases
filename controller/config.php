<?php 
//session_start();
/* DATABASE CONFIGURATION */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'asesoria');
//define("BASE_URL", "http://localhost/PHPLoginHash/"); // Eg. http://yourwebsite.com


function getDB() 
{
    $dbhost=DB_SERVER;
    $dbuser=DB_USERNAME;
    $dbpass=DB_PASSWORD;
    $dbname=DB_DATABASE;
    try {
        $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
        $dbConnection->exec("set names utf8");
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
    catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}
class Singleton{
    public $db;
    private static $dns = "mysql:host=localhost;dbname=crudclases";
    private static $user = "root";
    private static $pass = '';
    private static $instance;

    public function __construct(){
        try {
            $this->db = new PDO(self::$dns, self::$user, self::$pass);
            $this->db->exec("set names utf8");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
    public static function getInstance(){
        if(!isset(self::$instance)){
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }
}
?>