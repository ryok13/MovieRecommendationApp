<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied. Admins only.";
    exit();
}

$db = (new DBConnection())->getConnection();
$keyword = ['word' => ''];
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $db->prepare("SELECT * FROM keywords WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $keyword = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $word = trim($_POST['word']);

    if ($id) {
        $stmt = $db->prepare("UPDATE keywords SET word = ? WHERE id = ?");
        $stmt->bind_param("si", $word, $id);
    } else {
        $stmt = $db->prepare("INSERT INTO keywords (word) VALUES (?)");
        $stmt->bind_param("s", $word);
    }

    $stmt->execute();
    header("Location: view_keyword.php");
    exit();
}

$pageTitle = $id ? "Edit Keyword" : "Add Keyword";
include '../includes/header.php';
include '../includes/navigation.php';
?>

<main class="admin-container">
<h2><?= $pageTitle ?></h2>
<p style="margin-top: 10px; font-style: italic; color: #666;">
    * Please add a keyword number if you want to enter keyword. Below is the list of IDs and names.<br>
    1: Sci-Fi   2: Rommance  3: Superhero  4: Ghost  5: Time Travel <br>
    6: Friendship  7: Family  8: War  9: Adventure  10: Psychological
</p>
<form method="post">
    <label>Keyword: <input type="text" name="word" value="<?= htmlspecialchars($keyword['word']) ?>" required></label>
    <button type="submit">Save</button>
</form>

<p style="margin-top: 40px;">
    <a href="/user/home.php">← Back to User Panel</a>
</p>
</main>

<?php include '../includes/footer.php'; ?>
