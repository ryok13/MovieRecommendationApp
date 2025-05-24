<?php
require_once __DIR__ . '/../config/SystemSettings.php';

$sys = SystemSettings::getInstance();
if (!isset($pageTitle)) {
    $pageTitle = $sys->get('site_name') ?? 'Movie App';
}
$themeColor = $sys->get('theme_color') ?? '#007bff';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        :root {
            --theme-color: <?= htmlspecialchars($themeColor) ?>;
        }

        nav, footer, button {
            background-color: var(--theme-color);
        }

        nav ul li a:hover,
        button:hover {
            background-color: #0056b3;
        }

        h2 {
            color: var(--theme-color);
        }

        a {
            color: var(--theme-color);
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <?php if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false): ?>
        <link rel="stylesheet" href="/assets/css/admin.css">
    <?php endif; ?>
</head>
<?php
if (!isset($bodyClass)) {
    $bodyClass = '';
    if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
        $bodyClass = 'admin-page';
    }
}
?>
<body class="<?= htmlspecialchars($bodyClass) ?>">

