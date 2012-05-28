<form action="#">
<p>Type:</p>
<select id="newvariableselector">
<option value="0">Number</option>
<option value="1">Text</option>
<option value="2">Location</option>
<option value="3">Zone</option>
<option value="4">Boolean</option>
</select>
<p>Name:</p>
<input type="text" id="newvariablename" onclick="Variable.setAddFormType();" required />
<p>Value:</p>
<input type="text" id="newvariablevalue" onclick="Variable.setAddFormType();" required />
<input type="submit" style="width: 100px;" onclick="Variable.add()" /> 
</form>