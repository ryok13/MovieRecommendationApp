<nav>
    <ul>
        <li><a href="/index.php">Home</a></li>
        <li><a href="/user/movies.php">Movies</a></li>
        <li><a href="/user/search.php">Search</a></li>

        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
            <li><a href="/admin/movies_index.php">Admin Panel</a></li>
        <?php endif; ?>
        
        <li><a href="/user/logout.php">Logout</a></li>
    </ul>
</nav>
