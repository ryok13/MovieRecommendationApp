<?php
require_once 'DBConnection.php';

class SystemSettings {
    private static $instance = null;
    private $db;
    private $settings = [];

    private function __construct() {
        $this->db = DBConnection::getInstance(); // mysqli object
        $this->loadSettings();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new SystemSettings();
        }
        return self::$instance;
    }

    private function loadSettings() {
        $sql = "SELECT * FROM system_settings";
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $this->settings[$row['setting_key']] = $row['setting_value'];
        }
    }

    public function get($key) {
        return $this->settings[$key] ?? null;
    }
}
