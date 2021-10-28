<?php    
	if($_SERVER['REQUEST_METHOD'] == 'POST') { 
        if( $_FILES['file']['error'] != '4' ) { // 檢查有沒上傳圖檔
            $file = $_FILES['file']['tmp_name'] ;
            $fp = fopen($file, 'r');
            $rawDataSS1 = fread($fp, filesize($file));
            fclose($fp);
            $_SESSION['sessionImg'] = $encodedSS1Data = base64_encode($rawDataSS1); // 將檔案邊碼(base64)後放入SESSION
    }
}
	echo '<img src=data:image/;base64,'.$_SESSION['sessionImg'].'>' . "<br>";
		
	$tmp = $_FILES['file']['tmp_name'];
	$name = $_FILES['file']['name']; //完整路徑error

	$line = shell_exec("md5sum $name");
	
	echo $line . "<br>";
	echo $tmp . "<br>";
?>
