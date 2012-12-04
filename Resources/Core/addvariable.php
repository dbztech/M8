<form>
<p>Type:</p>
<select id="newvariableselector" onclick="Variable.setAddFormType();">
<option value="1">Text (HTML)</option>
<option value="0">Number</option>
<option value="4">Boolean</option>
</select>
<p>Name:</p>
<input type="text" id="newvariablename" required />
<p>Value:</p>
<input type="text" id="newvariablevalue" required />
<input type="button" value="Add" style="width: 100px;" onclick="Variable.add()" /> 
<input type="button" value="Close" style="width: 100px;" onclick="Dialog.close()" /> 
</form>