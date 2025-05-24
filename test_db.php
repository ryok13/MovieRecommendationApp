<?php
require_once 'config/config.php';
require_once 'config/DBConnection.php';

$db = (new DBConnection())->getConnection();
$result = $db->query("SELECT * FROM users");

while ($row = $result->fetch_assoc()) {
    echo "👤 Username: " . $row['username'] . "<br>";
}
?>
