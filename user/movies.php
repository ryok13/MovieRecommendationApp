<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';

$pageTitle = 'Movies';
include '../includes/header.php';
include '../includes/navigation.php';

$db = (new DBConnection())->getConnection();
$sql = "SELECT m.id, m.title, m.release_year, m.image_path, g.name AS genre 
        FROM movies m
        JOIN genres g ON m.genre_id = g.id
        ORDER BY m.title";
$result = $db->query($sql);
?>

<main class="movies-container">
    <h2>Movie List</h2>
    <div class="movie-list">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="movie-card">
            <a href="movie_details.php?id=<?= $row['id'] ?>">
                <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="movie-thumb">
                <h3><?= htmlspecialchars($row['title']) ?> (<?= $row['release_year'] ?>)</h3>
                <p><?= htmlspecialchars($row['genre']) ?></p>
            </a>
        </div>
    <?php endwhile; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
