<?php
include('core.php');
include('settings.php');

#Get variables
$type = $_GET['type'];
$query = $_GET['query'];

echo "Type = ".$type."<br /> Query = ".$query;

?>