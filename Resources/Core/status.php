<div id="status" style="display: none;">
<h1>M8 Status:</h1>
<h3>Database:</h3>
<?php
if ($database->test()) {
	echo "Database Online";
}
?>
<h3>PHP:</h3>
<iframe src="Resources/Core/test.php" style="width: 95%; border: 0px; border-radius: 5px; height: 600px;"></iframe>
</div>