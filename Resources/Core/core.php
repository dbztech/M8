<?php
#This is the core of M8
include('classes.php');
include('patch.php');
include('settings.php');

#Debug window
if ($debug) {
	echo '<div id="debug">Database Info: <br /> ';
	$database->info();
	$database->test();
	echo '</div>';
}

#echo "Core Initialized <br />";
?>