<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-1</title>
</head>
<body>
    <form action="" method="post">
        名前:<input type="text" name="name"><br>
        コメント:<input type="text" name="comment"><br>
        <input type="submit" name="submit">
    </form>
    <?php
        $filename="mission_3-1.txt";
        
        //ファイルが存在する場合の処理
        if(file_exists($filename)){
            
            $fp = fopen($filename,"a");
            //配列に読み込み
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            fclose($fp);
            
            //最終の番号取得
            $latest = explode("<>",$lines[count($lines)-1])[0];
        } else {
            //ファイルが存在しないときの処理
            $latest = 0;
        }
        echo $latest[0];
        
        //コメントと名前がPOSTされたときの処理        
        if(isset($_POST["name"]) && isset($_POST["comment"])){
            
            //コメントが空でないとき書き込み
            if($_POST["comment"] == ""){
                echo "コメントを入力してください";
            } else {
                $comment = $_POST["comment"];
            
                //名前が空のときの処理
                if($_POST["name"] != ""){
                    $name = $_POST["name"];
                } else {
                    $name = "名無しさん";
                }
            
                //書き込み
                $date = date("Y/m/d/ H:i:s");
                $str = $latest+1 . "<>" . $name . "<>" . $comment . "<>" . $date;
                $fp = fopen($filename,"a");
                fwrite($fp, $str.PHP_EOL);
                fclose($fp);
            }
        }
        

    ?>
</body>
</html>