<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
$pageTitle = 'Home';
include '../includes/header.php';
include '../includes/navigation.php';
include '../includes/topBarNav.php';
?>

<div class="main-wrapper">
    <main class="container">
    <h2>🎬 Welcome to the Movie Recommendation App</h2>

    <p>This is a platform where you can explore, search, and get recommendations for great movies!</p>
    <p>You're logged in as <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>.</p>
    </main>
</div>

<?php include '../includes/footer.php'; ?>
