<?php
require_once 'config.php';

class DBConnection {
    private static $instance = null;
    protected $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DBConnection();
        }
        return self::$instance->getConnection();
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
