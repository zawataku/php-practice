<?php
$dsn = "mysql:host=db;dbname=php_practice;charset=utf8mb4";
$user = "user";
$password = "password";
$pdo = null;

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "接続エラー: " . $e->getMessage();
    exit();
}

$pdo->exec("CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["content"])) {
    $content = $_POST["content"];
    $stmt = $pdo->prepare("INSERT INTO posts (content) VALUES (?)");
    $stmt->execute([$content]);
    header("Location: " . $_SERVER["SCRIPT_NAME"]);
    exit();
}

$posts = $pdo
    ->query("SELECT * FROM posts ORDER BY created_at DESC")
    ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ひとこと掲示板</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <h1>ひとこと掲示板</h1>
    <div class="post-form">
        <form action="" method="POST">
            <textarea name="content" rows="3" cols="50" placeholder="いまどうしてる？"></textarea>
            <br>
            <button type="submit">投稿する</button>
        </form>
    </div>

    <ul class="post-list">
        <?php foreach ($posts as $post): ?>
            <li>
                <p><?php echo $post["content"]; ?></p>
                <time><?php echo $post["created_at"]; ?></time>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
