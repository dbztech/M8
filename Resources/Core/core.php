<?php
#Initialize core variables
$version = "b0.0.1";

#This is the core of M8
include('classes.php');
include('patch.php');

#Initialize db connection
$database = new database();
include('settings.php');

#Initialize core classes
$page = new page();
$variable = new variable();
$file = new file();
$login = new login();

#Get cookies
$sessionhashcookie = $_COOKIE['sessionhash'];
$usernamecookie = $_COOKIE['username'];

if (isset($sessionhashcookie) && isset($usernamecookie)) {
	$login->cookiesexist = true;
} else {
	$login->cookiesexist = false;
}

#Debug window
if ($debug) {
	echo '<div id="debug">Database Info: <br /> ';
	$database->info();
	$database->test();
	echo '</div>';
}
if ($cookie && $ajax == false) {
	$login->username = "admin";
	$login->passwordplain = "GreenGreen12";
	$login->loginuser();
}

#echo "Core Initialized <br />";
?>