<?php
include('core.php');
include('settings.php');

#Get variables
$type = $_GET['type'];
$query = $_GET['query'];

$variable = new variable();

if (isset($_GET['type'])) {
	if ($type = 'variable') {
		if (isset($_GET['query'])) {
			$result = $variable->getvariable($query);
		}
	}
}

echo $result;
echo "<br /> Type = ".$type."<br /> Query = ".$query;
?>