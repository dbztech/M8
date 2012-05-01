<?php
#This is the basic M8 classes file
foreach (glob("Classes/*.php") as $filename)
{
    include $filename;
}

#Basic database interaction class
class database
{
    // property declaration
    private $dbuser = 'm8';
    private $dbpassword = 'hunter3';
    private $dbhost = 'localhost';
    private $database = 'm8db';
    private $prefix = 'meight';

    // method declaration
    public function info() {
    	echo "Database: ".$this->database."<br />";
        echo "Database User: ".$this->dbuser."<br />";
        echo "Database Host: ".$this->dbhost."<br />";
        echo "Database Prefix: ".$this->prefix."<br />";
    }

    public function test() {
    	$link = mysql_connect($this->dbhost, $this->dbuser, $this->dbpassword);
		if (!$link) {
	    	die('Could not connect: ' . mysql_error());
		}
		//echo 'Connected successfully';
		return(true);
		mysql_close($link);
    }

    public function returndata($query) {
    	$link = mysql_connect($this->dbhost, $this->dbuser, $this->dbpassword);

		// make foo the current db
		$db_selected = mysql_select_db($this->database, $link);
		if (!$db_selected) {
		    die ('Can\'t use foo : ' . mysql_error());
		}

		// Perform Query
		$result = mysql_query($query);

		// Check result
		// This shows the actual query sent to MySQL, and the error. Useful for debugging.
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    return($message);
		    die($message);
		}

		// Use result
		// Attempting to print $result won't allow access to information in the resource
		// One of the mysql result functions must be used
		// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
		while ($row = mysql_fetch_assoc($result)) {
		    return($row);
		}

		// Free the resources associated with the result set
		// This is done automatically at the end of the script
		mysql_free_result($result);
    }

    public function greatestid($query, $incriment) {
    	$link = mysql_connect($this->dbhost, $this->dbuser, $this->dbpassword);

		// make foo the current db
		$db_selected = mysql_select_db($this->database, $link);
		if (!$db_selected) {
		    die ('Can\'t use foo : ' . mysql_error());
		}

		// Perform Query
		$result = mysql_query($query);

		// Check result
		// This shows the actual query sent to MySQL, and the error. Useful for debugging.
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    return($message);
		    die($message);
		}

		// Use result
		// Attempting to print $result won't allow access to information in the resource
		// One of the mysql result functions must be used
		// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
		$id = 0;
		while ($row = mysql_fetch_assoc($result)) {
		    if ($row['id'] > $id) {
		    	$id = $row['id'];
		    }
		}

		$id = $id+$incriment;

		return $id;

		// Free the resources associated with the result set
		// This is done automatically at the end of the script
		mysql_free_result($result);
    }

    public function writedata($query) {
    	$link = mysql_connect($this->dbhost, $this->dbuser, $this->dbpassword);

		// make foo the current db
		$db_selected = mysql_select_db($this->database, $link);
		if (!$db_selected) {
		    die ('Can\'t use foo : ' . mysql_error());
		}

		// Perform Query
		$result = mysql_query($query);

		// Check result
		// This shows the actual query sent to MySQL, and the error. Useful for debugging.
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    return($message);
		    die($message);
		} else {
			return("Query Successful");
		}

		// Free the resources associated with the result set
		// This is done automatically at the end of the script
		mysql_free_result($result);
    }
}

class page
{
	//property declaration
	public $location = "index.php";

	//method declaration
	public function verifypage($pagename) {
		//Check if page exists
		$database = new database();
		$result = $database->returndata('SELECT * FROM `pages` WHERE `name` = "'.$pagename.'"');
		if (file_exists('Resources/Site/Code/'.$pagename.'.php')) {
			//Check database for page
			if (isset($result['id'])) {
				//Do nothing
				return true;
			} else {
				//INSERT INTO `m8db`.`pages` (`name`, `title`, `description`, `location`, `id`) VALUES ('demo', 'This is a Demo', 'Hazzah', '/Demp.php', '4')
				$result = $database->writedata("INSERT INTO `m8db`.`pages` (`name`, `title`, `description`, `location`, `id`) VALUES ('".$pagename."', '".$pagename."', 'No description currently', '/Resources/Site/Code/".$pagename.".php', '".$database->greatestid('SELECT * FROM `pages` WHERE 1',1)."')");
				return $result;
			}
		} else {
			return false;
		}
	}

	public function gettitle() {
		$database = new database();
		$result = $database->returndata('SELECT * FROM `pages` WHERE `location` = "'.$this->location.'"');
		return $result['title'];
	}

	public function getdesc() {
		$database = new database();
		$result = $database->returndata('SELECT * FROM `pages` WHERE `location` = "'.$this->location.'"');
		return $result['description'];
	}
}

class variable
{
	//property declaration
	//Not here yet

	#0 = Number
	#1 = Text
	#2 = Location
	#4 = Zone

	public function getvariable($name) {
		$database = new database();
		
	}

	public function getnumber($name) {
		$database = new database();
	}

	public function gettext($name) {
		$database = new database();
	}

	public function getlocation($name) {
		$database = new database();
	}

	public function getzone($name) {
		$database = new database();
	}
}

#echo "Classes Initialized <br />";
?>