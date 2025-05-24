<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';

if (!isset($_GET['id'])) {
    header("Location: movies.php");
    exit();
}

$db = (new DBConnection())->getConnection();
$stmt = $db->prepare("SELECT m.*, m.image_path, g.name AS genre 
                    FROM movies m 
                    JOIN genres g ON m.genre_id = g.id 
                    WHERE m.id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();
$recStmt = $db->prepare("
    SELECT m.id, m.title, r.reason
    FROM recommendations r
    JOIN movies m ON r.recommended_id = m.id
    WHERE r.movie_id = ? AND r.user_id = ?
");
$recStmt->bind_param("ii", $_GET['id'], $_SESSION['user_id']);
$recStmt->execute();
$recResult = $recStmt->get_result();
$recommendedMovies = $recResult->fetch_all(MYSQLI_ASSOC);
$reviewStmt = $db->prepare("
    SELECT u.username, r.comment, r.rating
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    WHERE r.movie_id = ?
");
$reviewStmt->bind_param("i", $_GET['id']);
$reviewStmt->execute();
$reviewResult = $reviewStmt->get_result();
$reviews = $reviewResult->fetch_all(MYSQLI_ASSOC);

if (!$movie) {
    echo "Movie not found.";
    exit();
}

$bodyClass = 'movie-details-page';

$pageTitle = $movie['title'];
include '../includes/header.php';
include '../includes/navigation.php';
?>

<div class="main-wrapper">
    <main class="container">
        <h2><?= htmlspecialchars($movie['title']) ?></h2>
        <div class="movie-detail-box">
            <?php if ($movie['image_path']): ?>
                <img src="<?= htmlspecialchars($movie['image_path']) ?>" alt="Poster" class="movie-detail-img">
            <?php endif; ?>
            <div class="movie-detail-text">
                <p><strong>Genre:</strong> <?= htmlspecialchars($movie['genre']) ?></p>
                <p><strong>Release Year:</strong> <?= $movie['release_year'] ?></p>
                <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($movie['description'])) ?></p>
            </div>
        </div>
        <?php if (!empty($recommendedMovies)): ?>
            <section style="margin-top: 40px; text-align: left;">
                <h3>Recommended Movies</h3>
                <ul>
                    <?php foreach ($recommendedMovies as $rec): ?>
                        <li>
                            <a href="movie_details.php?id=<?= $rec['id'] ?>"><?= htmlspecialchars($rec['title']) ?></a>
                            <small>: <?= htmlspecialchars($rec['reason']) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>
        <?php if (!empty($reviews)): ?>
            <section style="margin-top: 40px; text-align: left;">
                <h3>User Reviews</h3>
                <?php foreach ($reviews as $review): ?>
                    <div class="review" style="margin-bottom: 20px;">
                        <p>
                            <strong><?= htmlspecialchars($review['username']) ?></strong>
                            (Rating: <?= (int)$review['rating'] ?>/5)<br>
                            <?= nl2br(htmlspecialchars($review['comment'])) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </main>
</div>

<?php include '../includes/footer.php'; ?>
