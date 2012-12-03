<?php include('classes.php'); ?>
<!DOCTYPE HTML>
<html>
<!--
This site is written and maintained by:
Brendan Boyle,
Connor Olson,
Michael Wilke
-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php 
if ($uacheck->ismobile()) {
	if (false) {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
	}
}

echo m8::description();
?>


<link rel="stylesheet" type="text/css" href="/styles.css" />
<link rel="stylesheet" type="text/css" href="/mobilestyles.css" />

<!--<script src="js/navScroll.js" type="text/javascript"></script>-->

<!--<link rel="stylesheet" type="text/css" href="/boxstyles.css" />-->
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="ieoverride.css" />
<![endif]-->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>-->
<script type="text/javascript" src="/scripts.js"></script>
<link rel="icon" type="image/png" href="favicon.png">
<link rel="apple-touch-icon" href="apple-icon.png" />
<title><?php m8::title(); ?></title>
<?php echo $headerstuff; ?>
</head>

<body onLoad="load();">

<div class="newnav" id="headnav">
<a href="/" class="newnavitem" style="border-left: 0px;">Home</a>
<a href="/Team" class="newnavitem">Team 3926</a>
<a href="/Robot" class="newnavitem">The Robot</a>
<a href="/Sponsors" class="newnavitem">Our Sponsors</a>
<a href="/wordpress" class="newnavitem">News</a>
<a href="/Media" class="newnavitem">Media</a>
<a href="/Wiki" class="newnavitem">Wiki</a>
<a href="mailto:robotics@moundsparkacademy.org" class="newnavitem">Contact Us</a>
<a href="/Search" class="newnavitem" style="border-right: 0px;">Search</a>
</div>

<div id="website">
<div id="nav">
<a href="/"><img src="/images/MPAror/logoNav.svg" alt="logo" id="logo"></a>
<div id="headerimg1" class="headerimg" style="width: 100%; height: 130px; background: url('/images/Slideshow/slideshow1.png'); z-index: 0; position: relative;"></div>

</div>
<?php flush(); ?>