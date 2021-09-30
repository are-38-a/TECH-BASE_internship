<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-2</title>
</head>
<body>
    <?php
    $dsn = 'mysql:dbname=tb230560db;host=localhost';
    $user = 'tb-230560';
    $password = '8BBVygfsTu';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    $sql = "CREATE TABLE IF NOT EXISTS tbtest"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT"
    .");";
    $stmt = $pdo->query($sql);
    ?>
</body>
</html>