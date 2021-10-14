<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-5</title>
</head>
<body>
    <form action="" method="post">
        名前:<input type="text" name="name">
        コメント:<input type="text" name="comment">
        <input type="submit" name="submit"><br>
    </form>
    
    <?php
        $dsn = 'mysql:dbname=********;host=localhost';
        $user = '********';
        $password = '********';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
                
        if(isset($_POST["name"]) && isset($_POST["comment"])){
            $sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $name = $_POST["name"];
            $comment = $_POST["comment"]; 
            $sql -> execute();
            echo "db送信完了";
        }
        
    ?>
</body>
</html>