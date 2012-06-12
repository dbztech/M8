<div id="editVariables">
<h1>Variables Info:</h1>
<form>
<table class="admintable" id="variablestable">
<?php $variable->getallvariables(); ?>
</table>
<input type="button" value="Submit Changes" style="width: 110px;" />
<input type="button" value="Add Variable" style="width: 100px;" onclick="Variable.addDialog()" />
</form>
<br />
</div>