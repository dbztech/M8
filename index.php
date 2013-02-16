<?php
include('Resources/Core/core.php');
include('Resources/Site/options.php');
#echo "<!doctype html><!-- Powered by M8 -->";
if (isset($_GET['in'])) {
	if ($_GET['in'] == "Admin" or $_GET['in'] == "AdminPanel") {
		$authenticated = false;
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$login->username = $_POST['username'];
			$login->passwordplain = $_POST['password'];
			$authenticated = $login->loginuser();
            if ($_GET['in'] == "Admin" and $authenticated) {
                    lowlevel::redirect("AdminPanel");
            }
		} else {
			if ($login->checkcookie()) {
				#echo "Cookie Verified";
				$authenticated = true;
                if ($_GET['in'] == "Admin") {
                    lowlevel::redirect("AdminPanel");
                }
			} else {
				$authenticated = false;
			}
		}
		if ($authenticated) {
			page::$location = '/Resources/Core/index.php';
			include('Resources/Core/header.php');
			if ($leftnav) {
				include('Resources/Core/leftnav.php');
			}
			include('Resources/Core/index.php');
			include('Resources/Core/footer.php');
			flush();
		} else {
			include('Resources/Core/login.php');
			flush();
		}
	} elseif ($_GET['in'] == "Logout") {
		#echo 'Logout';
		include('Resources/Core/logout.php');
	} else {
		if ($page->verifypage($_GET['in'])) {
			page::$location = '/Resources/Site/Code/'.$_GET['in'].'.php';
			#include('Resources/Core/header.php');
			#if ($leftnav) {
			#	include('Resources/Core/leftnav.php');
			#}
            page::devmode();
			include('Resources/Site/Code/'.$_GET['in'].'.php');
			#include('Resources/Core/footer.php');
		} else {
			echo "404";
			flush();
		}
	}
} else {
	if ($page->verifypage("index")) {
		page::$location = '/Resources/Site/Code/index.php';
		include('Resources/Site/Code/index.php');
	} else {
		echo "404";
		flush();
	}
}
?>