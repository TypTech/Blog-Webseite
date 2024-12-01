<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Basisverzeichnis der Beiträge
$postsDir = __DIR__ . '/posts/';

// Beitragstitel aus der URL abrufen
$postTitle = isset($_GET['post']) ? $_GET['post'] : null;

// Sicherstellen, dass der Titel valide ist
$postPath = $postsDir . $postTitle;
if ($postTitle && is_dir($postPath)) {
    $contentFile = $postPath . '/content.html';
    if (file_exists($contentFile)) {
        $content = file_get_contents($contentFile);
    } else {
        $content = '<p>Der Beitrag enthält keinen Inhalt.</p>';
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($postTitle); ?> - Blog</title>
    <link rel="stylesheet" href="css/style.css"> <!-- CSS-Datei -->
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($postTitle); ?></h1>
        <a href="/blog" class="btn-back-home">Zurück zum Blog</a>
        <div class="repo-details">
            <?= $content; ?>
        </div>
    </div>
</body>
</html>
