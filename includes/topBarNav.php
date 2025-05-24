<div class=\"top-bar\">
    <span class=\"logo\">🎬 Movie App</span>
    <span class=\"welcome\">
        <?php if (isset($_SESSION['username'])): ?>
        Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!
        <?php endif; ?>
    </span>
</div>
