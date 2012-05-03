<?php
include('core.php');
include('settings.php');

#Get variables
$type = $_GET['type'];
$query = $_GET['query'];

$variable = new variable();
$file = new file();

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
}

echo $result;
#echo "<br /> Type = ".$type."<br /> Query = ".$query;
?>