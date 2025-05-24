<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied. Admins only.";
    exit();
}

$db = (new DBConnection())->getConnection();
$result = $db->query("SELECT * FROM keywords ORDER BY word");

$pageTitle = "Keywords";
include '../includes/header.php';
include '../includes/navigation.php';
?>

<main class="admin-container">
<h2>Keywords</h2>
<a href="manage_keyword.php">➕ Add New Keyword</a>
<table border="1" cellpadding="5">
    <tr><th>Word</th><th>Action</th></tr>
    <?php while ($k = $result->fetch_assoc()): ?>
        <tr>
        <td><?= htmlspecialchars($k['word']) ?></td>
        <td>
            <a href="manage_keyword.php?id=<?= $k['id'] ?>">Edit</a>
        </td>
        </tr>
    <?php endwhile; ?>
</table>

<p style="margin-top: 40px;">
    <a href="/user/home.php">← Back to User Panel</a>
</p>
</main>

<?php include '../includes/footer.php'; ?>
