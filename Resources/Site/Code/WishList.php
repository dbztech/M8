<?php 
$headerstuff = NULL;
$pageTitle = "MPA Robotics - Wish List";
include('header.php');
?>

<div id="content" style="padding: 0px;">
<?php
$browser = $_SERVER['HTTP_USER_AGENT'];
#$browser = "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)";
#echo $browser;
preg_match("/Trident/",$browser, $result);
if ($result) {
echo '<div style="width: 100%; height: 50px; margin-top: 50px; background: red;">Sorry! Currently we are unable to support your browser bucause it does not follow web standards. Please use a browser like <a href="http://google.com/Chrome" style="color: white;">Google Chrome</a> to fix this problem and enjoy the full web.</div>';
} else {
echo '<iframe src="https://docs.google.com/spreadsheet/ccc?key=0At6btS17d6VHdFlYQUtfeHY1bHRTYTB4M1N6dDhadXc#gid=0" style="width: 100%; border: 0px; height: 800px; margin-top: -5px;"></iframe>';
}
?>
<br />
<br />
<br />
<br /><br /><br />
<br /><br /><br /><br /><br /><br /><br />
</div>


<?php 
$footerstuff = NULL;
include('footer.php');
?>
