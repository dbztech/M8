<?php
include('core.php');
include('settings.php');

#Get variables
$type = $_GET['type'];
$query = $_GET['query'];
$ajaxhash = $_GET['verify'];

$hash = $database->returndata('SELECT `hash` FROM `users` WHERE `username` = "admin"');

if (false) {
   	echo "Password verified!";
   	if (isset($_GET['type'])) {
		if ($type == 'variable') {
			if (isset($_GET['query'])) {
				$result = $variable->getvariable($query);
			}
		}

		if ($type == 'content') {
			if (isset($_GET['query'])) {
				$result = $file->getfilecontent($query);
			}
		}

		if ($type == 'query') {
			if (isset($_GET['query'])) {
				
			}
		}
	}
} else {
	echo "Not verified";
}

echo $result;
#echo "<br /> Type = ".$type."<br /> Query = ".$query;
?>