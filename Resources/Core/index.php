<div id="content">

<div class="contentblock" id="Overview">
<div class="selector">
<p class="selected" id="infoButton" onClick="Selector.setCurrent('info','overview');">Info</p>
<p id="statusButton" onClick="Selector.setCurrent('status','overview');">Status</p>
</div>
<p class="rightcontext" id="title">#M8 Overview</p>
<br />
<br />
<br />
<br />
<?php include("info.php"); ?>
<?php include("status.php"); ?>
</div>

<div class="contentblock" id="Pages">
<div class="selector">
<p class="selected" id="editButton">Edit</p>
</div>
<p class="rightcontext" id="title">#M8 Pages</p>
<br />
<br />
<br />
<br />
<?php include("edit.php"); ?>
</div>

</div>