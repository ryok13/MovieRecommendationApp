<?php
require_once '../config/config.php';
require_once '../includes/sess_auth.php';
require_once '../config/DBConnection.php';
require_once '../config/SystemSettings.php';

$pdo = DBConnection::getInstance();
$sys = SystemSettings::getInstance();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo "Access denied. Admins only.";
    exit();
}

$db = (new DBConnection())->getConnection();
$settings = [];

$res = $db->query("SELECT * FROM system_settings");
while ($row = $res->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $val) {
        $stmt = $db->prepare("UPDATE system_settings SET setting_value = ? WHERE setting_key = ?");
        $stmt->bind_param("ss", $val, $key);
        $stmt->execute();
    }
    header("Location: system_index.php?updated=1");
    exit();
}

$pageTitle = "System Settings";
include '../includes/header.php';
include '../includes/navigation.php';
?>

<main class="admin-container">
<h2>System Settings</h2>
<?php if (isset($_GET['updated'])): ?><p style="color:green;">Settings updated.</p><?php endif; ?>
<form method="post">
    <?php foreach ($settings as $key => $val): ?>
        <label><?= htmlspecialchars(ucwords(str_replace('_', ' ', $key))) ?>: 
        <input type="text" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($val) ?>">
        </label>
    <?php endforeach; ?>
    <button type="submit">Save Settings</button>
</form>

<p style="margin-top: 40px;">
    <a href="/user/home.php">← Back to User Panel</a>
</p>
</main>

<?php include '../includes/footer.php'; ?>
