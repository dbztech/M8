<html>
<head>
<title><?php echo $page->gettitle(); ?></title>
<script type="text/javascript" src="Resources/Core/scripts.js"></script>
<link rel="stylesheet" type="text/css" href="Resources/Core/css/styles.css">
<link rel="stylesheet" type="text/css" href="Resources/Core/css/selector.css">
<link rel="stylesheet" type="text/css" href="Resources/Core/css/splash.css">
<link rel="stylesheet" type="text/css" href="Resources/Core/css/rightcontext.css">
<meta name="description" content="<?php echo $page->getdesc(); ?>">
</head>
<body>
<div id="loginbox">
<p id="logintitle">#M8 Login</p>
<div class="hr" style="width: 90%; height: 2px; margin-top: 5px;"></div>
<form method="post" action="/Admin" style="margin-top: 20px;">
<p>Username:</p>
<input type="email" class="logininput" name="username" required />
<p>Password:</p>
<input type="password" class="logininput" name="password" required />
<input type="submit" style="width: 100px;" />
</form>
</div>
</body>
</html>