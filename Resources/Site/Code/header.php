<html>
<head>
<title>#M8</title>
<script type="text/javascript" src="/M8/Resources/Site/Code/scripts.js"></script>
<link rel="stylesheet" type="text/css" href="/M8/Resources/Site/Code/styles.css">
</head>
<?php
if ($splash) {
	echo '<body onLoad="load();">';
	echo '<div id="splash"><img src="Resources/Site/Files/Continue.png" alt="Continue" id="splashcontinue" onClick="unveil();" /><p id="splashtext">#M8</p></div>';
} else {
	echo '<body onLoad="showContent();">';
}
?>