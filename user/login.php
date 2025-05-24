<?php
require_once '../config/config.php';
require_once '../config/DBConnection.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new DBConnection())->getConnection();
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($user = $res->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = ($user['username'] === 'admin');
            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<?php $pageTitle = 'Login'; include '../includes/header.php'; ?>
<?php include '../includes/navigation.php'; ?>

<div class="main-wrapper">
    <main class="container">
        <h2>Login</h2>
        <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>
        <form method="post">
            <label>Username: <input type="text" name="username" required></label><br>
            <label>Password: <input type="password" name="password" required></label><br>
            <button type="submit">Login</button>
        </form>
    </main>
</div>

<?php include '../includes/footer.php'; ?>

