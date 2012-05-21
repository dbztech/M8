<?php
include('Resources/Core/core.php');
include('Resources/Site/options.php');
#echo "<!doctype html><!-- Powered by M8 -->";
if (isset($_GET['in'])) {
	if ($_GET['in'] == "Admin") {
		$authenticated = false;
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$login->username = $_POST['username'];
			$login->passwordplain = $_POST['password'];
			$authenticated = $login->loginuser();
		} else {
			if ($login->checkcookie()) {
				#echo "Cookie Verified";
				$authenticated = true;
			} else {
				$authenticated = false;
			}
		}
		if ($authenticated) {
			$page->location = '/Resources/Core/index.php';
			include('Resources/Core/header.php');
			if ($leftnav) {
				include('Resources/Core/leftnav.php');
			}
			include('Resources/Core/index.php');
			include('Resources/Core/footer.php');
		} else {
			include('Resources/Core/login.php');
		}
	} 
	if ($_GET['in'] == "Logout") {
		echo 'Logout';
		include('Resources/Core/logout.php');
	} else {
		if ($page->verifypage($_GET['in'])) {
			$page->location = '/Resources/Site/Code/'.$_GET['in'].'.php';
			#include('Resources/Core/header.php');
			#if ($leftnav) {
			#	include('Resources/Core/leftnav.php');
			#}
			include('Resources/Site/Code/'.$_GET['in'].'.php');
			#include('Resources/Core/footer.php');
		} else {
			echo "404";
		}
	}
} else {
	if (file_exists('Resources/Site/Code/index.php')) {
		$page->location = '/Resources/Site/Code/index.php';
		include('Resources/Site/Code/index.php');
	} else {
		echo "404";
	}
}
?>