<?php
#Initialize core variables
$version = "b0.0.1";

#This is the core of M8
include('classes.php');
include('patch.php');
include('settings.php');

#Initialize core classes
$database = new database();
$page = new page();
$variable = new variable();
$file = new file();
$login = new login();
$bcrypt = new Bcrypt(15);

#Get cookies
$sessionhashcookie = $_COOKIE['sessionhash'];
$usernamecookie = $_COOKIE['username'];

#Debug window
if ($debug) {
	echo '<div id="debug">Database Info: <br /> ';
	$database->info();
	$database->test();
	echo '</div>';
}
if ($cookie) {
	echo $bcrypt->hash('$2a$15$p1sD941DBOS.aUqWiWJ39OUMfsvD4sFqcyY8dFiLnkelTxHeRdmuS');
}

#echo "Core Initialized <br />";
?>