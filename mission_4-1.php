<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-1</title>
</head>
<body>
    <?php
    $dsn = 'mysql:dbname=tb230560db;host=localhost';
    $user = 'tb-230560';
    $password = '8BBVygfsTu';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    ?>
</body>
</html>