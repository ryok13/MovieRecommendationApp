<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
require_once '../config/config.php';
require_once '../includes/header.php';
require_once '../includes/navigation.php';

session_start();
session_destroy();
?>

<div class="main-wrapper">
    <main class="container">
        <h2>You have been logged out.</h2>
        <p>Thanks for visiting the Movie App! 😊</p>
        <p><a href="/user/login.php">Log in again</a></p>
    </main>
</div>

<?php include '../includes/footer.php'; ?>