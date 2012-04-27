<div id="content">

<div id="contentblock">
<div class="selector">
<p>Info</p>
<p>Status</p>
</div>
<p class="rightcontext" id="title">#M8 Overview</p>
<br />
<br />
<br />
<br />
<h1>M8 Status:</h1>
<h3>Database:</h3>
<?php
if ($database->test()) {
	echo "Database Online";
}
?>
<h3>PHP:</h3>
<?php
phpinfo();
?>
</div>

</div>