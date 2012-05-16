<?php
echo "<!doctype html><!-- Powered by M8 -->";
include('Resources/Core/core.php');
include('Resources/Site/settings.php');
if (isset($_GET['redirect'])) {
	if ($_GET['redirect'] == "Admin") {
		$page->location = '/Resources/Core/index.php';
		include('Resources/Core/header.php');
		if ($leftnav) {
			include('Resources/Core/leftnav.php');
		}
		include('Resources/Core/index.php');
		include('Resources/Core/footer.php');
	} else {
		if ($page->verifypage($_GET['redirect'])) {
			$page->location = '/Resources/Site/Code/'.$_GET['redirect'].'.php';
			#include('Resources/Core/header.php');
			#if ($leftnav) {
			#	include('Resources/Core/leftnav.php');
			#}
			include('Resources/Site/Code/'.$_GET['redirect'].'.php');
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