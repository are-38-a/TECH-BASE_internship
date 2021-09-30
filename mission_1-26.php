<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-26</title>
</head>
<body>
    <?php
        //ファイルに書き込み
        $str = "Hello World3";
        $filename="mission_1-24.txt";
        $fp = fopen($filename,"a");
        fwrite($fp, $str.PHP_EOL);
        fclose($fp);
        echo "書き込み成功！<br>";

        //ファイルが存在する場合は一行ずつ表示
        if(file_exists($filename)){
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                echo $line . "<br>";
            }
        }
    ?>
</body>
</html>