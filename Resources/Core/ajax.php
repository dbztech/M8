<?php
include('core.php');
include('settings.php');

#Get variables
$type = $_GET['type'];
$query = $_GET['query'];

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
			echo "NOT THERE YET: ".$query;
		}
	}
}

echo $result;
#echo "<br /> Type = ".$type."<br /> Query = ".$query;
?>