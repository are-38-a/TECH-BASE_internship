<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-27</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="num">
        <input type="submit" name="submit">
    </form>
    <?php
        $filename="mission_1-27.txt";
        
        if(isset($_POST["num"])){
            $num = $_POST["num"];
            
            //数字なら書き込み
            if(is_numeric($num)){
                $fp = fopen($filename,"a");
                fwrite($fp, $num.PHP_EOL);
                fclose($fp);
                echo "書き込み成功！<br>";
            } else {
                echo "数字を入力してください!";
            }
        }

        //ファイルが存在する場合の処理
        if(file_exists($filename)){
            
            //配列に読み込み
            $lines = file($filename,FILE_IGNORE_NEW_LINES);

            //FizzBuzz
            foreach($lines as $line){
                $num = $line;
                if ($num % 3 == 0 && $num % 5 == 0) {
                    echo "FizzBuzz<br>";
                } elseif ($num % 3 == 0) {
                    echo "Fizz<br>";
                } elseif ($num % 5 == 0) {
                    echo "Buzz<br>";
                } else {
                    echo $num . "<br>";
                }
            }
        }
        
    ?>
</body>
</html>