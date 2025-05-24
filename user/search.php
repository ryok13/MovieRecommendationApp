<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';

$db = (new DBConnection())->getConnection();
$results = [];

if (isset($_GET['q']) && trim($_GET['q']) !== '') {
    $q = '%' . $db->real_escape_string($_GET['q']) . '%';
    $stmt = $db->prepare("SELECT m.id, m.title, m.release_year, g.name AS genre
                        FROM movies m
                        JOIN genres g ON m.genre_id = g.id
                        WHERE m.title LIKE ? OR m.description LIKE ?");
    $stmt->bind_param("ss", $q, $q);
    $stmt->execute();
    $results = $stmt->get_result();
}

$pageTitle = 'Search';
include '../includes/header.php';
include '../includes/navigation.php';
?>

<div class="main-wrapper">
    <main class="container">
        <h2>Search Movies</h2>
        <p style="margin-top: 10px; font-style: italic; color: #666;">
            * Currently, keyword does not work for Search now.<br>
            * Please enter movie title
        </p>
        <!-- <p style="margin-top: 10px; font-style: italic; color: #666;">
            * Please enter a keyword number if you want to enter keyword. Below is the list of IDs and names.<br>
                1: Sci-Fi   2: Rommance  3: Superhero  4: Ghost  5: Time Travel <br>
                6: Friendship  7: Family  8: War  9: Adventure  10: Psychological
        </p> -->

        <form method="get">
            <input type="text" name="q" placeholder="Enter movie title or keyword" required>
            <button type="submit">Search</button>
        </form>

        <?php if (isset($_GET['q'])): ?>
            <h3>Results for \"<?= htmlspecialchars($_GET['q']) ?>\"</h3>
            <?php if ($results->num_rows > 0): ?>
                <ul>
                <?php while ($row = $results->fetch_assoc()): ?>
                    <li>
                    <a href="movie_details.php?id=<?= $row['id'] ?>">
                        <?= htmlspecialchars($row['title']) ?> (<?= $row['release_year'] ?>) - <?= htmlspecialchars($row['genre']) ?>
                    </a>
                    </li>
                <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No movies found.</p>
            <?php endif; ?>
        <?php endif; ?>
    </main>
</div>

<?php include '../includes/footer.php'; ?>
