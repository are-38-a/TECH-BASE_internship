<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-2</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str" value="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
        $filename="mission_2-2.txt";

        //コメントがPOSTされたときの処理        
        if(isset($_POST["str"]) && $_POST["str"] != ""){
            $str = $_POST["str"];
            
            //書き込み
            $fp = fopen($filename,"w");
            fwrite($fp, $str.PHP_EOL);
            fclose($fp);
            
            //メッセージの条件分岐
            if($str == "完成"){
                echo "おめでとう！<br>";
            } else {
                echo "書き込み成功！<br>";
            }
            
        } elseif(isset($_POST["str"])) {
            echo "内容を入力してください<br>";
        }
        
        //ファイルが存在する場合の処理
        if(file_exists($filename)){
            
            $fp = fopen($filename,"a");
            //配列に読み込み
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            fclose($fp);
            
            //表示
            foreach($lines as $line){
                echo $line . "<br>";
            }
        }
    ?>
</body>
</html>