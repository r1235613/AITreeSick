<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" /> 
	<title>Document</title>
	<style>
		*{
            margin: 0;
            padding: 0;
        }
        .body1{
            width: 100%;
            height: 680px;
            position: relative;
            background-image: url("img/background.jpg");
            background-attachment: fixed; /* 固定圖像 */
            background-repeat: no-repeat;
            background-position: center center;
            z-index: -9999;
        }
		.result{
			position: absolute;
			right: 37.5px;
			top: 33.5px;
			width: 300px;
			height: 550px;
			z-index: 1;
			background-color: #eee;
			overflow: auto;
			display:inline-block;
			box-shadow: 10px 10px 100px hsla(240, 40%, 15%);
		}
		.mypic{
			width: 300px;
			height: 250px;
		}
		.mypic .mypic1{
			width: 300px;
			height: 250px;
		}
		.mypic img{
			width : 250px ;
			height : 250px;
		}
		.present{
			width:300px;
			height:auto;
			background-color: #eee;
		}
		.present p{
			font-size : 20px;
			text-align:center;
			line-height:60px;
		}
		.present .p1{
			font-size : 35px;
			text-align:center;
			font-weight:900;
			color : red;
		}
		.goback{
			position: absolute;;
			right: 15px;
			bottom: 0px;
			z-index: 999;
		}
		.goback a{
			text-decoration: none;
            color: #000;
            font-size: 20px;
            font-weight: 900;
            background-color: rgb(105, 204, 92);
            border-bottom: 2px solid #000;
            border-radius: 100px;
            padding: 3px 8px;
		}
		.likesick{
			font-size:35px;
			font-weight:900;
			margin-left: 20px;
		}
		.pictext{
			font-weight:900;
			padding: 0 20px 20px;
		}

		@media screen and (min-width:768px){
          .body1{
            width: 100%;
            height: 605px;
            position: relative;
            background-image: url("img/background.jpg");
            background-attachment: fixed; /* 固定圖像 */
            background-repeat: no-repeat;
            background-position: center center;
            z-index: -9999;
        }
		.result{
			position: absolute;
			right: 150px;
			top: 130px;
			width: 950px;
			height: 320px;
			background-color: #fff;
			z-index: 1;
			background-color: #eee;
			overflow: auto;
			display:inline-block;
		}
		.mypic{
			width: 900px;
			height: 250px;
		}
		.mypic img{
			width : 250px ;
			height : 250px;
		}
		.present{
			width:500px;
			height:auto;
			background-color: #eee;
			position: absolute;
			top: 0px;
			right: 50px;
		}
		.present p{
			font-size : 20px;
			text-align:center;
			line-height: 57px;
		}
		.present .p1{
			font-size : 35px;
			text-align:center;
			font-weight:900;
			color : red;
		}
		.present .p1:last-child::after{
            content: '';
            width: 100%;
            height: 5px;
            display: inline-block;
            background: red;
            border-radius: 1px;
            vertical-align: middle;
        }
		.goback{
			position: fixed;
			right: 50px;
			bottom: 50px;
			z-index: 1;
		}
		.goback a{
			text-decoration: none;
            color: #000;
            font-size: 20px;
            font-weight: 900;
            background-color: rgb(105, 204, 92);
            border-bottom: 2px solid #000;
            border-radius: 100px;
            padding: 3px 8px;
		}
		.likesick{
			font-size:35px;
			font-weight:900;
			margin-left: 20px ;
		}
		.pictext{
			padding:  0 0 20px 25px ;
			font-weight:900;
			width: 800px;
		}

	</style>
</head>
<body>
	<div class="body1"></div>
	<div class="goback">
			<a href="identify.html">重新辨識</a>	
	</div>
		<div class="result">
			<?php 
				putenv('PYTHONPATH=/home/isaac/.local/lib/python3.8/site-packages');
				$error = $_FILES['file']['error'];
					$fp = fopen($_FILES['file']['tmp_name'], 'r');
				$rawDataSS1 = fread($fp,filesize($_FILES['file']['tmp_name']));
					fclose($fp);
				$_SESSION['sessionImg'] = $encodedSS1Data = base64_encode($rawDataSS1);
					$dir = "/var/www/html/upload_photo/";
				$name = mb_convert_encoding($_FILES['file']['name'], "utf-8",'auto');

				switch($error){
					case(0):
						?>
						<div class="mypic">
							<?php
								echo '<img class="mypic1" src=data:image/;base64,'.$_SESSION['sessionImg'];
								(move_uploaded_file($_FILES['file']['tmp_name'], $dir.$name));
							?>						
						</div>
						<?php
						break;
					case(4):
						echo "NO UPLOAD";
						break;
					case(6):
						echo "CANT FIND TMP";
						break;
					case(8):
						echo "PHP ERROR";
						break;
				}

				$cls_list = array('授粉不全','果實 炭疽病','果實 黑斑病','果實(未成熟)','果實成熟','白龜神','紅斑炭疽病','紅蜘蛛','缺朋 缺鈣','葉子','葉子 百粉病','葉蟬','葉部 黑斑病或炭疽病','蒂腐病 果實','薊馬 果實','藻斑病','檬果壯鋏普癭蚋','鑽心蟲');

				$py = $dir."compare.py";
				$num = shell_exec("python3 ".$py." ".$dir.$name);
				$num = trim($num);
				$pro = shell_exec("python3 ".$dir."test.py ".$dir.$name);
				$pro = trim($pro);
			?>

				<div class="present">
					<?php
						echo '<p>此張照片得了</p>'
						.'<p class="p1">'.$cls_list[$num].'</p>'
						.'<p>的機率為：</p>'
						.'<p class="p1">' .$pro .'</p>';
					?>
				</div>

			<?php
				$i = 1;
				$path = "/var/www/html/sulotion/".$num;
				$con = shell_exec('ls '.$path.' -l|grep "^-"| wc -l');
			?>
				<div class="likesick">
					<?php
						echo "<p>類似病狀：</p>";
					?>
				</div>
			<?php
				while($i <= $con){
					$img_file = $path.'/'.$i.'.jpg';
					$imgData = base64_encode(file_get_contents($img_file));
					$src = 'data:'.mime_content_type($img_file).';base64,'.$imgData;

					echo '<img src="'.$src.'" style="border : 0px #ccc solid;padding:20px">';

					$i++;
				}
				$sick = '/var/www/html/sick/'.$num.'.txt';

				if(file_exists($sick)){
					$sp = fopen($sick,'r');
					$str = fread($sp, filesize($sick));
					$str =  str_replace("\r\n","<br />", $str);
					echo '<div class="pictext" style="text-align:left;">'.$str.'</div>';
				}
			?>
			
		</div>
</body>
</html>


