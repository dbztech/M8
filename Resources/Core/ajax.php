<?php
$ajax = true;
include('core.php');
include('settings.php');

#Get variables
$type = $_GET['type'];
$query = $_GET['query'];
$ajaxhash = $_GET['verify'];
$username = $_GET['username'];

$user = $database->returndata('SELECT * FROM `users` WHERE `username` = "'.$username.'"');

#echo $ajaxhash." ".$user['sessionhash']." ";


if ($user['sessionhash'] == $ajaxhash) {
	#echo "Password verified!";
	if (isset($_GET['type']) && isset($_GET['query'])) {
		if ($type == 'variable') {
			$result = $variable->getvariable($query);
		}

		if ($type == 'content') {
			$result = $file->getfilecontent($query);
		}

		if ($type == 'query') {
			$query = stripslashes($query);
			#echo $query;
			database::writedata($query);
		}

		if ($type == 'logout') {
			$login->username = $query;
			$login->logout();
		}
		
		if ($type == 'pages') {
			$result = $page->getallpages();
		}
		
		if ($type == 'variables') {
			$result = $variable->getallvariables();
		}
	}
} else {
	echo "Not verified";
}

echo $result;
#echo "<br /> Type = ".$type."<br /> Query = ".$query;
?>