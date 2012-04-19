<?php
echo "<!doctype html><!-- Powered by M8 -->";
include('Resources/Core/core.php');
include('Resources/Site/settings.php');
if (isset($_GET['redirect'])) {
	echo $page->verifypage($_GET['redirect']);
	//print_r($database->returndata('SELECT * FROM `pages`'));
	include('Resources/Site/Code/'.$_GET['redirect'].'.php');
} else {
	include('Resources/Site/Code/index.php');
}
?>