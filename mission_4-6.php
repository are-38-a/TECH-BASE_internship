<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-6</title>
</head>
<body>
    <form action="" method="post">
        名前:<input type="text" name="name">
        コメント:<input type="text" name="comment">
        <input type="submit" name="submit"><br>
    </form>
    
    <?php
        $dsn = 'mysql:dbname=tb230560db;host=localhost';
        $user = 'tb-230560';
        $password = '8BBVygfsTu';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        
        if(isset($_POST["name"]) && isset($_POST["comment"])){
            $sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $name = $_POST["name"];
            $comment = $_POST["comment"]; 
            $sql -> execute();
            echo "db送信完了<br>";
        }
        
        $sql = 'SELECT * FROM tbtest';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
        echo "<hr>";
        }
    ?>
</body>
</html>