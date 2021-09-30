<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1</title>
</head>
<body>
    <p>削除・編集を含め自由にテストしてもらって構いません</p>
    <p>テーマ「PHP」</p>
    <form action="" method="post">
        番号:<input type="number" name="id_edit">
        パスワード:<input type="text" name="password_edit">
        <input type="submit" name="edit" value="編集"><br>
    </form>
    <?php
        //db接続
        $dsn = 'mysql:dbname=tb230560db;host=localhost';
        $user = 'tb-230560';
        $password = '8BBVygfsTu';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        //テーブルがなければ作成する
        $sql = "CREATE TABLE IF NOT EXISTS mission51"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name VARCHAR(32),"
        . "comment TEXT,"
        . "date DATETIME,"
        . "password VARCHAR(32)"
        .");";
        $stmt = $pdo->query($sql);

        //変数初期化
        $id_edit = "";
        $password_edit = "";
        $comment_edit = "";
        $name_edit = "";

        //編集のときの処理
        if(isset($_POST["edit"])){
            $id_edit = $_POST["id_edit"];
            $password_edit = $_POST["password_edit"];
            
            //指定idの書き込みを取得
            $sql = "SELECT id, name, comment, password FROM mission51 WHERE id=:id_edit";
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindparam(':id_edit', $id_edit, PDO::PARAM_STR);
            $stmt -> execute();
            $results = $stmt->fetchAll();
            
            //結果がある場合
            if(count($results) != 0){
                //パスワードがあっていれば編集開始
                if($results[0]["password"] == $password_edit){
                    $comment_edit = $results[0]["comment"];
                    $name_edit = $results[0]["name"];
                } else {
                    echo "パスワードが不正です";
                    $id_edit = "";
                }
            } else {
            //結果がない場合
                echo "その番号の書き込みは存在しません";
                $id_edit = "";
            }
            
        }

    ?>
    <form action="" method="post">
        <p>パスワードを指定しない場合「0000」に設定されます</p>
        名前:<input type="text" name="name" value="<?= $name_edit ?>">
        パスワード:<input type="text" name="password" value="<?= $password_edit ?>"><br>
        コメント:<input type="text" name="comment" value="<?= $comment_edit ?>">
        <input type="hidden" name="id" value="<?= $id_edit ?>">
        <input type="submit" name="submit">
    </form>
    <?php
        //submitされたかつコメントが空でないときの処理
        if(isset($_POST["submit"]) && $_POST["comment"] != ""){
            //変数に格納
            if($_POST["name"] != ""){
                $name = $_POST["name"];
            } else {
                $name = "名無しさん";
            }
            
            if($_POST["password"] != ""){
                $password = $_POST["password"];
            } else {
                $password = "0000";
            }
            
            if($_POST["id"] != ""){
                $id = $_POST["id"];
            }else{
                $id = "";
            }
            
            $comment = $_POST["comment"];
            $date = date("Y-m-d H:i:s");
        
            //新規投稿
            if($_POST["id"] == ""){
                $sql = $pdo -> prepare("INSERT INTO mission51 (name, comment, date, password) VALUES (:name, :comment, :date, :password)");
                $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
                $sql -> bindParam(':date', $date, PDO::PARAM_STR);
                $sql -> bindParam(':password', $password, PDO::PARAM_STR);
                $sql -> execute();
                echo "書き込み完了<br>";    
            } else {
                $sql = $pdo -> prepare('UPDATE mission51 SET name=:name,comment=:comment,password=:password WHERE id=:id');
                $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
                $sql -> bindParam(':password', $password, PDO::PARAM_STR);
                $sql -> bindParam(':id', $id, PDO::PARAM_STR);
                $sql -> execute();
                echo "編集完了<br>"; 
            }
            
        }
        
        
        //submitされたがコメントが空のときの処理
        if(isset($_POST["submit"]) && $_POST["comment"] == ""){
            echo "コメントを入力してください<br>";
        }

        //dbのテーブルを読み込んで表示
        $sql = 'SELECT * FROM mission51';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            echo $row['id'].' ';
            echo "名前:".$row['name']." ";
            echo "日時:".$row['date'].'<br>';
            echo $row['comment'].'<br>';
            echo "<hr>";
        }

    ?>
    <form action="" method="post">
        番号:<input type="number" name="id_delete">
        パスワード:<input type="text" name="password_delete">
        <input type="submit" name="delete" value="削除">
    </form>
    <?php
        if(isset($_POST["delete"])){
            $id = $_POST["id_delete"];
            $password = $_POST["password_delete"];
            
            //パスワードが一致するか確かめる
            $password_is_correct = 0;
            $sql = "SELECT id, password FROM mission51 WHERE id=:id";
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindparam(':id', $id, PDO::PARAM_STR);
            $stmt -> execute();
            $results = $stmt->fetchAll();
            if(count($results) != 0){
                if($results[0]["password"] == $password){
                    $password_is_correct = 1;
                } else {
                    echo "パスワードが不正です";
                }
            } else {
                echo "その番号の書き込みは存在しません";
            }
            
            //パスワードがあっていれば削除
            if($password_is_correct == 1){
                $sql = 'delete from mission51 where id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                echo "削除しました";
            }
        }

    ?>

</body>
</html>
