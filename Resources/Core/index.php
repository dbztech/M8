<div id="dialog">
<p id="dialogTitle">Hey<p>X</p></p>
<p id="dialogContent">Hey</p>
</div>

<div id="content">

<div class="contentblock" id="Overview">
<div class="selector">
<p class="selected" id="infoButton" onClick="Selector.setCurrent('info','overview');">Info</p>
<p id="statusButton" onClick="Selector.setCurrent('status','overview');">Status</p>
</div>
<p class="rightcontext" id="title"><?php echo $variable->getvariable('overview'); ?></p>
<br />
<br />
<?php include("info.php"); ?>
<?php include("status.php"); ?>
</div>

<div class="contentblock" id="Pages">
<div class="selector">
<p class="selected" id="editButton">Edit</p>
</div>
<p class="rightcontext" id="title"><?php echo $variable->getvariable('pages'); ?></p>
<br />
<br />
<?php include("edit.php"); ?>
</div>

<div class="contentblock" id="Variables">
<div class="selector">
<p class="selected" id="editVariablesButton" onClick="Selector.setCurrent('editVariables','variables');">Edit</p>
<p id="searchButton" onClick="Selector.setCurrent('search','variables');">Search</p>
</div>
<p class="rightcontext" id="title"><?php echo $variable->getvariable('variables'); ?></p>
<br />
<br />
<?php include("variables.php"); ?>
<?php include("search.php"); ?>
</div>

<div class="contentblock" id="Settings">
<div class="selector">
<p class="selected" id="settingsButton">Settings</p>
</div>
<p class="rightcontext" id="title"><?php echo $variable->getvariable('settings'); ?></p>
<br />
<br />
<?php include("settingsedit.php"); ?>
</div>

</div>