<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied. Admins only.";
    exit();
}

$db = (new DBConnection())->getConnection();

$id = $_GET['id'] ?? null;
$movie = [
    'title' => '', 'genre_id' => '', 'release_year' => '',
    'description' => '', 'image_path' => '', 'rating' => '', 'status' => 'active'
];

if ($id) {
    $stmt = $db->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $movie = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie = $_POST;
    if ($id) {
        $stmt = $db->prepare("UPDATE movies SET title=?, genre_id=?, release_year=?, description=?, image_path=?, rating=?, status=? WHERE id=?");
        $stmt->bind_param("sisssssi", $_POST['title'], $_POST['genre_id'], $_POST['release_year'], $_POST['description'], $_POST['image_path'], $_POST['rating'], $_POST['status'], $id);
    } else {
        $stmt = $db->prepare("INSERT INTO movies (title, genre_id, release_year, description, image_path, rating, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssss", $_POST['title'], $_POST['genre_id'], $_POST['release_year'], $_POST['description'], $_POST['image_path'], $_POST['rating'], $_POST['status']);
    }
    $stmt->execute();
    header("Location: movies_index.php");
    exit();
}

$genres = $db->query("SELECT id, name FROM genres");

$pageTitle = $id ? "Edit Movie" : "Add Movie";
include '../includes/header.php';
include '../includes/navigation.php';
?>

<main class="admin-container">
<h2><?= $pageTitle ?></h2>
<form method="post">
    <label>Title: <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>" required></label><br>
    <label>Genre: 
        <select name="genre_id" required>
        <?php while ($g = $genres->fetch_assoc()): ?>
            <option value="<?= $g['id'] ?>" <?= ($movie['genre_id'] == $g['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($g['name']) ?>
            </option>
        <?php endwhile; ?>
        </select>
    </label><br>
    <label>Release Year: <input type="number" name="release_year" value="<?= htmlspecialchars($movie['release_year']) ?>" required></label><br>
    <label>Description:<br><textarea name="description" rows="5"><?= htmlspecialchars($movie['description']) ?></textarea></label><br>
    <label for="image_path">Image Path:</label><input type="text" name="image_path" id="image_path" value="<?= htmlspecialchars($movie['image_path'] ?? '') ?>">
    <label>Rating: <input type="text" name="rating" value="<?= htmlspecialchars($movie['rating']) ?>"></label><br>
    <label>Status: 
        <select name="status">
        <option value="active" <?= ($movie['status'] === 'active') ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= ($movie['status'] === 'inactive') ? 'selected' : '' ?>>Inactive</option>
        </select>
    </label><br><br>
    <button type="submit">Save</button>
</form>

<p style="margin-top: 40px;">
    <a href="/user/home.php">← Back to User Panel</a>
</p>
</main>

<?php include '../includes/footer.php'; ?>
