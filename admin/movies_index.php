<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied. Admins only.";
    exit();
}

$pageTitle = 'Manage Movies';
include '../includes/header.php';
include '../includes/navigation.php';

$db = (new DBConnection())->getConnection();
$result = $db->query("SELECT m.id, m.title, g.name AS genre, m.status 
                    FROM movies m 
                    JOIN genres g ON m.genre_id = g.id 
                    ORDER BY m.title");
?>

<main class="admin-container">
<h2>Admin Dashboard</h2>
<ul style="margin-bottom: 40px;">
    <li><a href="manage_genre.php">Manage Genres</a></li>
    <li><span style="color: gray; cursor: default;">Manage Keywords(This is not available now)</span></li>
    <li><a href="manage_movie.php">Manage Movies</a></li>
    <li><a href="system_index.php">System Settings</a></li>
</ul>

<h2>Movie Management</h2>
<a href="manage_movie.php">➕ Add New Movie</a>
<table border="1" cellpadding="5">
    <tr><th>Title</th><th>Genre</th><th>Status</th><th>Action</th></tr>
    <?php while ($movie = $result->fetch_assoc()): ?>
        <tr>
        <td><?= htmlspecialchars($movie['title']) ?></td>
        <td><?= htmlspecialchars($movie['genre']) ?></td>
        <td><?= $movie['status'] ?></td>
        <td>
            <a href="manage_movie.php?id=<?= $movie['id'] ?>">Edit</a> |
            <a href="update_status.php?id=<?= $movie['id'] ?>">Toggle Status</a>
        </td>
        </tr>
    <?php endwhile; ?>
</table>

<p style="margin-top: 40px;">
    <a href="/user/home.php">← Back to User Panel</a>
</p>
</main>

<?php include '../includes/footer.php'; ?>
