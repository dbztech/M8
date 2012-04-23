<html>
<head>
<title><?php echo $page->gettitle(); ?></title>
<script type="text/javascript" src="/M8/Resources/Site/Code/scripts.js"></script>
<link rel="stylesheet" type="text/css" href="/M8/Resources/Site/Code/styles.css">
</head>
<?php
if ($splash) {
	echo '<body onLoad="load();">';
	include('splash.php');
} else {
	echo '<body onLoad="showContent();">';
}
?>