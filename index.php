<?php
require_once 'config/config.php';

if (isset($_SESSION['user_id'])) {
    header('Location: user/home.php');
    exit();
}

$pageTitle = 'Welcome';
include 'includes/header.php';
include 'includes/navigation.php';
?>

<main class="main-wrapper">
    <div class="container">
        <h2>Welcome to the Movie Recommendation App 🎬</h2>
        <p>This is a platform where you can explore, search, and get recommendations for great movies!</p>
        <p><a href="user/login.php">Login</a> to get started.</p>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
