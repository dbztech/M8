<?php
//To Connor and/or Brendan,
//You can make the actual video viewing fancier is you so wish,
//Like with that lightbox thingy, however I refuse to touch javascript
//So you can do it on your own
//Everything should be setup just fine for you to be able to do that
//--Schuyler
function sortdir($path){
	$files = array();
	$accepted_extensions = array('jpg','png','gif','jpeg','mp4');
	if(is_dir($path)){
		foreach(scandir($path, 1) as $file){
			if(in_array(end(explode(".", $file)), $accepted_extensions)){	
				array_push($files, $file);
				}
			}
		}
	return $files;
	}
	
function makethumb($files, $path, $save){
	$saveFiles = sortdir($save);
	foreach($files as $key => $value){
		if(!in_array(str_replace(".mp4", ".jpg",$value), $saveFiles)){
			$value = '/' . $value;
			$command = "ffmpeg -i " . $path . $value . " -vcodec mjpeg -vframes 1 -an -f rawvideo -s 320x240 -ss 00:00:10 " . $save . str_replace(".mp4", ".jpg",$value);
			exec($command);
			}
		}
	return;
	}
?>
<html>
<body>
<?php
if (!$_POST){
	echo "<p>what files would you like to view?</p>
	<form method='post' name='path' action='$_SERVER[SCRIPT_NAME]'>
	<select name='path'>
	<option>images</option>
	<option>Videos</option>
	</select>
	<input type='submit' value='choose'>
	</form>";
	}
else if ($_POST['path'] == 'images'){
	$path = $_POST['path'];
	$files = sortdir($path);
	$v = 0;
	echo "<table border='0' cellpadding='25'>";
		foreach($files as $key => $value){
			if($v%3 == 0){
				echo "</tr><tr>";
				}
			echo "<td><a href='{$path}/{$value}'><img src='{$path}/{$value}' height='200' width='300' /></a></td>";
			$v++;
			}
	echo "</tr></table>";
	}
else if ($_POST['path'] == 'Videos'){
	$path = $_POST['path'];
	$files = sortdir($path);
	makethumb($files, $path, 'images/thumbs');
	$v = 0;
	echo "<table border='0' cellpadding='25'>";
		foreach($files as $key => $value){
			if($v%3 == 0){
				echo "</tr><tr>";
				}
			echo "<td><h1 align=center>{$value}</h1><a href='{$path}/{$value}'><img src='images/thumbs/" . str_replace(".mp4", ".jpg", $value) . "' height='240' width='320' /></a></td>";
			$v++;
			}
	echo "</tr></table>";
	}

?>

</body>
</html>
		

