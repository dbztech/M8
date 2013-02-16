<div id="users" style="display: none;">
<h1>Create User:</h1>
<form action="/Resources/Core/ajax.php" method="get">
<input type="hidden" name="verify" value="<?php echo $login->sessionhash; ?>" />
<input type="hidden" name="username" value="<?php echo $login->username; ?>" />
<input type="hidden" name="type" value="adduser" />
<input type="hidden" name="query" value="nonajax" />
<p>Username:</p>
<input type="email" name="addusername" required />
<p>Password:</p>
<input type="password" name="addpassword" required />
<p>User Level:</p>
<input type="number" name="addlevel" value="0" required />
<input type="submit" />
</form>
<h1>Manage Users:</h1>
<table class="admintable" id="usertable">
<?php login::getallusers(); ?>
</table>
</div>