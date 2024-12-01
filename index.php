<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

// YAML-Konfiguration laden
$configPath = __DIR__ . '/config.yaml';
$config = [];
if (file_exists($configPath)) {
    $config = Yaml::parseFile($configPath);
}

// Basisverzeichnis der Beiträge
$postsDir = __DIR__ . '/posts/';

// Liste der Beiträge laden
$posts = [];
if (is_dir($postsDir)) {
    $folders = array_filter(glob($postsDir . '*'), 'is_dir');
    foreach ($folders as $folder) {
        $folderName = basename($folder);
        $postConfig = $config['posts'][$folderName] ?? ['display' => true, 'title' => $folderName];
        if ($postConfig['display']) {
            $posts[] = [
                'title' => $postConfig['title'],
                'path' => $folderName
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="css/style.css"> <!-- CSS-Datei -->
</head>
<body>
    <div class="container">
        <h1>Blog</h1>
        <a href="/overview" class="btn-back-home">Zurück zum Blog</a>
        <div class="repo-list">
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="repo-item">
                        <a href="post.php?post=<?= urlencode($post['path']); ?>" class="repo-link">
                            <?= htmlspecialchars($post['title']); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Keine Beiträge gefunden.</p>
            <?php endif; ?>
        </div>
    </div>
    <footer>
        <p style="text-align: center; color: #f5f5f5; font-size: 1em; margin-top: 40px;"><?php echo date("Y"); ?> Project by TypTech. Visit here: <a href="https://github.com/TypTech/Github-Repo-Blog" target="_blank">Github-Repo-Blog</a> </p>
    </footer>
</body>
</html>
