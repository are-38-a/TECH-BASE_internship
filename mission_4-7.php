<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-7</title>
</head>
<body>
    ID=1の書き込みを変更します。
    <form action="" method="post">
        名前:<input type="text" name="name">
        コメント:<input type="text" name="comment">
        <input type="submit" name="submit" value="変更"><br>
    </form>
    
    <?php
        $dsn = 'mysql:dbname=tb230560db;host=localhost';
        $user = 'tb-230560';
        $password = '8BBVygfsTu';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        
        if(isset($_POST["name"]) && isset($_POST["comment"])){
            $id = 1; //変更する投稿番号
            $name = $_POST["name"];
            $comment = $_POST["comment"]; 
            $sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
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