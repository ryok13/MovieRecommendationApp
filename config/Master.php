<?php
require_once 'SystemSettings.php';

class Master {
    public $db;
    public $settings;

    public function __construct() {
        $this->db = (new DBConnection())->getConnection();
        $this->settings = new SystemSettings();
    }
}
?>
