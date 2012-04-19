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
		echo 'Connected successfully';
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
	//Not here yet

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
				return false;
			}
		} else {
			return false;
		}
	}
}

#echo "Classes Initialized <br />";
?>