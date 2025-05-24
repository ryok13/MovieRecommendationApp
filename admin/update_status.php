<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied. Admins only.";
    exit();
}

if (isset($_GET['id'])) {
    $db = (new DBConnection())->getConnection();
    $stmt = $db->prepare("UPDATE movies SET status = IF(status='active','inactive','active') WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
}
header("Location: movies_index.php");
exit();
