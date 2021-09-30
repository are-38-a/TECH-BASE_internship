<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-8</title>
</head>
<body>
    ID=2の書き込みを削除します。
    <form action="" method="post">
        <button type="submit" name="execute">実行</button><br>
    </form>
    
    <?php
        $dsn = 'mysql:dbname=tb230560db;host=localhost';
        $user = 'tb-230560';
        $password = '8BBVygfsTu';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        
        if(isset($_POST["execute"])){
            $id = 2; //変更する投稿番号
            $sql = 'delete from tbtest where id=:id';
            $stmt = $pdo->prepare($sql);
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