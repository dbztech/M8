<?php
$ajax = true;
include('core.php');
include('settings.php');

#Get variables
$type = $_GET['type'];
$query = $_GET['query'];
$ajaxhash = $_GET['verify'];
$username = $_GET['username'];


#Non ajax variables
if ($query == "nonajax") {
	$ajax = false;
}
#Add User
$addusername = $_GET['addusername'];
$addpassword = $_GET['addpassword'];
$addlevel = $_GET['addlevel'];

$user = $database->returndata('SELECT * FROM `users` WHERE `username` = "'.$username.'"');

#echo $ajaxhash." ".$user['sessionhash']." ";


if ($user['sessionhash'] == $ajaxhash) {
	#echo "Password verified!";
	if (isset($_GET['type']) && isset($_GET['query'])) {
		if ($type == 'variable') {
			$result = $variable->getvariable($query);
		}

		if ($type == 'content') {
			$result = $file->getfilecontent($query);
		}

		if ($type == 'query') {
			$query = stripslashes($query);
			#echo $query;
			database::writedata($query);
		}

		if ($type == 'logout') {
			$login->username = $query;
			$login->logout();
		}
		
		if ($type == 'pages') {
			$result = $page->getallpages();
		}
		
		if ($type == 'variables') {
			$result = $variable->getallvariables();
		}
        
        if ($type == 'addvariable') {
            $input = explode(",",$query);
			$result = variable::addvariable($input[0],$input[1],$input[2]);
		}
        
        if ($type == 'removevariable') {
			$result = variable::removevariable($query);
		}
        
        if ($type == 'editvariable') {
            $input = explode(",",$query);
			$result = variable::editvariable($input[0],$input[1],$input[2]);
		}
		
		if ($type == 'adduser') {
			#echo "Here";
			$result = $login->createuser($addusername, $addpassword, $addlevel, true);
		}
	}
} else {
	echo "Not verified";
}

if($ajax) {
	echo $result;
} else {
	echo "<!doctype><html><head><meta http-equiv='Refresh' content='0;url=javascript:history.go(-1)'></head><body>Redirecting....... <br /> ".$result."</body></html>";
}
#echo "<br /> Type = ".$type."<br /> Query = ".$query;
?>