<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied. Admins only.";
    exit();
}

$db = (new DBConnection())->getConnection();
$genre = ['name' => ''];
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $db->prepare("SELECT * FROM genres WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $genre = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);

    if ($id) {
        $stmt = $db->prepare("UPDATE genres SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
    } else {
        $stmt = $db->prepare("INSERT INTO genres (name) VALUES (?)");
        $stmt->bind_param("s", $name);
    }

    $stmt->execute();
    header("Location: view_genre.php");
    exit();
}

$pageTitle = $id ? "Edit Genre" : "Add Genre";
include '../includes/header.php';
include '../includes/navigation.php';
?>

<main class="admin-container">
<h2><?= $pageTitle ?></h2>
<p style="margin-top: 10px; font-style: italic; color: #666;">
    * Below is the list of genre.<br>
    1: Action   2: Drama  3: Comedy  4: Thriller  5: Animation <br>
    6: Romance  7: Horror  8: Sci-Fi  9: Fantasy  10: Documentary
</p>
<form method="post">
    <label>Genre Name: <input type="text" name="name" value="<?= htmlspecialchars($genre['name']) ?>" required></label>
    <button type="submit">Save</button>
</form>

<p style="margin-top: 40px;">
    <a href="/user/home.php">← Back to User Panel</a>
</p>
</main>

<?php include '../includes/footer.php'; ?>
