<html>
<head>
<title><?php echo $page->gettitle(); ?></title>
<script type="text/javascript" src="Resources/Core/scripts.js"></script>
<link rel="stylesheet" type="text/css" href="Resources/Core/css/styles.css">
<link rel="stylesheet" type="text/css" href="Resources/Core/css/selector.css">
<link rel="stylesheet" type="text/css" href="Resources/Core/css/splash.css">
<link rel="stylesheet" type="text/css" href="Resources/Core/css/rightcontext.css">
<link rel="stylesheet" type="text/css" href="Resources/Core/css/dragresize.css">
<meta name="description" content="<?php echo $page->getdesc(); ?>">
</head>
<?php
if ($splash) {
	echo '<body onLoad="load();">';
	include('splash.php');
} else {
	echo '<body onLoad="showContent();">';
}
?>