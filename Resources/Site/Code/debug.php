<?php
ini_set('track_errors', 1); 
echo "<div class='info'>";
echo "CUR_PAGE: " . $_SERVER['SCRIPT_NAME'] . "</br>";
echo "HTTP_REFERER: " . $_SERVER['HTTP_REFERER'] . "</br>";
echo "HTTP_USER_AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "</br>";
echo "Timestamp (d-m-y h:m:s): " . date("d-m-y H:i:s");
echo "</div></br>";
if (!$_POST['submit']==Submit){
echo "<div class='userInput'>
<form method=POST action='/debug.php'>
<textarea cols='40' rows='8' name='userInput'>
Please describe any extra details 
</textarea>
<input type='hidden' name='referer' value='{$_SERVER['HTTP_REFERER']}' />
<input type='submit' name='submit'>
</form>
</div>";
}
else {
echo "Thanks for your input!";
$fh = fopen('debug.log', a) or die($php_errormsg);
$data = "Timestamp (d-m-y h:m:s): " . date("d-m-y H:i:s") . "\n";
$data .= "CUR_PAGE: " . $_SERVER['HTTP_REFERER'] . "\n";
$data .= "HTTP_REFERER: " . $_POST['referer'] . "\n";
$data .= "HTTP_USER_AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "\n";

fwrite($fh, $data);
fwrite($fh, "User Comment: " . $_POST['userInput'] . "\n\n");
fclose($fh);
}
?>
