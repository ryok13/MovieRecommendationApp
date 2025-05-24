<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied. Admins only.";
    exit();
}

$db = (new DBConnection())->getConnection();
$result = $db->query("SELECT * FROM genres ORDER BY name");

$pageTitle = "Genres";
include '../includes/header.php';
include '../includes/navigation.php';
?>

<main class="admin-container">
<h2>Genres</h2>
<a href="manage_genre.php">➕ Add New Genre</a>
<table border="1" cellpadding="5">
    <tr><th>Name</th><th>Action</th></tr>
    <?php while ($g = $result->fetch_assoc()): ?>
        <tr>
        <td><?= htmlspecialchars($g['name']) ?></td>
        <td>
            <a href="manage_genre.php?id=<?= $g['id'] ?>">Edit</a>
        </td>
        </tr>
    <?php endwhile; ?>
</table>

<p style="margin-top: 40px;">
    <a href="/user/home.php">← Back to User Panel</a>
</p>
</main>

<?php include '../includes/footer.php'; ?>
