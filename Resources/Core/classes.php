<?php
#This is the basic M8 classes file
foreach (glob("Classes/*.php") as $filename)
{
    include $filename;
}

#Basic database interaction class
class database
{
	#initialize variables. These are later changed in settings.php
    static protected $dbuser = 'm8';
    static protected $dbpassword = 'hunter3';
    #Do Not Set to localhost, does not work in all environments
    static protected $dbhost = '127.0.0.1';
    static protected $database = 'm8db';
    static protected $prefix = 'meight';

	public static function setcredentials($user, $password, $host = '127.0.0.1', $db = 'm8db', $pre = 'm8db') {
    	// property declaration
    	$result = 'Credential(s) not set: ';
    	$error = 0;
    	if (is_string($user)) {database::$dbuser = $user;}
    	else {
    		$error = 1;
    		$result .= '$dbuser ';
    	}
    	
    	if (is_string($password)) {database::$dbpassword = $password;}
    	else {
    		$error = 1;
    		$result .= '$dbpassword ';
    	}
    	
    	if (is_string($host)) {database::$dbhost = $host;}
    	else {
    		$error = 1;
    		$result .= '$dbhost ';
    	}
    	
    	if (is_string($db)) {database::$database = $db;}
    	else {
    		$error = 1;
    		$result .= '$database ';
    	}
    	
    	if (is_string($pre)) {database::$prefix = $pre;}
    	else {
    		$error = 1;
    		$result .= '$prefix';
    	}
    	if (!$error) {$result = 'Success!';}
    	return $result;
    }

    // method declaration
    public static function info() {
    	echo "Database: ".database::$database."<br />";
        echo "Database User: ".database::$dbuser."<br />";
        echo "Database Host: ".database::$dbhost."<br />";
        echo "Database Prefix: ".database::$prefix."<br />";
    }

    public static function test() {
    	$link = mysql_connect(database::$dbhost, database::$dbuser, database::$dbpassword);
		if (!$link) {
	    	die('Could not connect: ' . mysql_error());
		}
		//echo 'Connected successfully';
		return(true);
		mysql_close($link);
    }

    public static function returndata($query) {
    	$link = mysql_connect(database::$dbhost, database::$dbuser, database::$dbpassword);

		// make foo the current db
		$db_selected = mysql_select_db(database::$database, $link);
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

    public static function returnmultiplerows($query) {
    	$link = mysql_connect(database::$dbhost, database::$dbuser, database::$dbpassword);

		// make foo the current db
		$db_selected = mysql_select_db(database::$database, $link);
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
		return $result;

		// Free the resources associated with the result set
		// This is done automatically at the end of the script
		mysql_free_result($result);
    }

    public static function writedata($query) {
    	$link = mysql_connect(database::$dbhost, database::$dbuser, database::$dbpassword);

		// make foo the current db
		$db_selected = mysql_select_db(database::$database, $link);
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
		$result = database::returndata('SELECT * FROM `pages` WHERE `name` = "'.$pagename.'"');
		if (file_exists('Resources/Site/Code/'.$pagename.'.php')) {
			//Check database for page
			if (isset($result['id'])) {
				//Do nothing
				return true;
			} else {
				#FIX: Take database name ect. from settings above/in settings file
				//INSERT INTO `m8db`.`pages` (`name`, `title`, `description`, `location`, `id`) VALUES ('demo', 'This is a Demo', 'Hazzah', '/Demo.php', '4')
				$result = database::writedata("INSERT INTO `pages` (`name`, `title`, `description`, `location`) VALUES ('".$pagename."', '".$pagename."', 'No description currently', '/Resources/Site/Code/".$pagename.".php')");
				return $result;
			}
		} else {
			return false;
		}
	}

	public function gettitle() {
		$result = database::returndata('SELECT * FROM `pages` WHERE `location` = "'.$this->location.'"');
		return $result['title'];
	}

	public function getdesc() {
		$result = database::returndata('SELECT * FROM `pages` WHERE `location` = "'.$this->location.'"');
		return $result['description'];
	}

	public function getallpages() {
		$result = database::returnmultiplerows('SELECT * FROM `pages`');
		$pass = 0;
		while ($row = mysql_fetch_assoc($result)) {
			$pass++;
		    echo "<tr>";
		    echo '<td><input type="text" id="'.$row['id'].'name'.'" value="'.$row['name'].'" onblur="pagewrite('.$row['id'].', 0'.');" /></td>';
		    echo '<td><input type="text" id="'.$row['id'].'title'.'" value="'.$row['title'].'" onblur="pagewrite('.$row['id'].', 1'.');" /></td>';
		    echo '<td><input type="text" id="'.$row['id'].'description'.'" value="'.$row['description'].'" onblur="pagewrite('.$row['id'].', 2'.');" /></td>';
		    echo '<td><input type="text" id="'.$row['id'].'location'.'" value="'.$row['location'].'" onblur="pagewrite('.$row['id'].', 3'.');" /></td>';
		    echo "</tr>";
		}
	}
}

class variable
{
	#0 = Number
	#1 = Text
	#2 = Location
	#4 = Zone
	#5 = Boolean

	public function getvariable($name) {
		$output = database::returndata('SELECT * FROM `variables` WHERE `name` = "'.$name.'"');
		if (isset($output)) {
			if ($output['type'] == 0 && isset($output['num'])) {
				#echo "Number";
				return $output['num'];
			}
			if ($output['type'] == 1 && isset($output['text'])) {
				#echo "Text";
				return $output['text'];
			}
			if ($output['type'] == 2 && isset($output['location'])) {
				#echo "Location";
				return $output['location'];
			}
			if ($output['type'] == 3 && isset($output['zone'])) {
				#echo "Zone";
				return $output['zone'];
			}
			if ($output['type'] == 4 && isset($output['boolean'])) {
				#echo "Zone";
				if ($output['boolean'] == 1) {
					return true;
				} else {
					return false;
				}
			}
		} else {
			return "Variable Does Not Exist";
		}
	}

	public function getallvariables() {
		$result = database::returnmultiplerows('SELECT * FROM `variables`');
		$pass = 0;
		while ($row = mysql_fetch_assoc($result)) {
			$pass++;
		    echo "<tr>";
		    echo '<td><input type="text" id="'.$row['id'].'name'.'" value="'.$row['name'].'" onblur="variablewrite('.$row['id'].', 0'.');" /></td>';
		    echo '<td><input type="text" id="'.$row['id'].'value'.'" value="'.$this->getvariable($row['name']).'" onblur="variablewrite('.$row['id'].', 1'.');" /></td>';
		    echo "</tr>";
		}
	}
}

class file
{
	public function getfilecontent($location) {
		if ($this->verifyfile($location)) {
			echo file_get_contents($location);
		}
	}

	public function verifyfile($location) {
		if (file_exists($location)) {
			#echo $location." Exists";
			return true;
		} else {
			#echo $location." Does Not Exists";
			return false;
		}
	}
}

class login extends Bcrypt
{

	public $username;
	public $passwordplain;
	public $cookiesexist = false;


	public function checklogin() {
		$user = database::returndata('SELECT * FROM `users` WHERE `username` = "'.$this->username.'"');
		if ($this->verify($this->passwordplain, $user['hash'])) {
			return true;
		} else {
			return false;
		}
	}

	public function checkcookie() {
		if ($this->cookiesexist) {
			$user = database::returndata('SELECT * FROM `users` WHERE `username` = "'.$this->username.'"');
			#echo "Session: ".$sessionhashcookie."<br /> Username: ".$usernamecookie."<br /> Hash: ".$user['random'];
			if ($this->verify($sessionhashcookie, $user['random'])) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function loginuser() {
		if ($this->checklogin()) {
			$user = database::returndata('SELECT * FROM `users` WHERE `username` = "'.$username.'"');
			if ($this->verify($password, $user['hash'])) {
				$sessionhash = $bcrypt->hash($user['random']);
				#echo "<br />".$sessionhash."<br />";
			} else {
				$sessionhash = "SECURITY ERROR";
			}
			#setcookie("sessionhash", $sessionhash);
			#setcookie("username", $username);
		}
	}
}




#######################
##Third Party Classes##
#######################

class Bcrypt {
  private $rounds;
  public function __construct($rounds = 12) {
    if(CRYPT_BLOWFISH != 1) {
      throw new Exception("bcrypt not supported in this installation. See http://php.net/crypt");
    }

    $this->rounds = $rounds;
  }

  public function hash($input) {
    $hash = crypt($input, $this->getSalt());

    if(strlen($hash) > 13)
      return $hash;

    return false;
  }

  public function verify($input, $existingHash) {
    $hash = crypt($input, $existingHash);

    return $hash === $existingHash;
  }

  private function getSalt() {
    $salt = sprintf('$2a$%02d$', $this->rounds);

    $bytes = $this->getRandomBytes(16);

    $salt .= $this->encodeBytes($bytes);

    return $salt;
  }

  private $randomState;
  private function getRandomBytes($count) {
    $bytes = '';

    if(function_exists('openssl_random_pseudo_bytes') &&
        (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN')) { // OpenSSL slow on Win
      $bytes = openssl_random_pseudo_bytes($count);
    }

    if($bytes === '' && is_readable('/dev/urandom') &&
       ($hRand = @fopen('/dev/urandom', 'rb')) !== FALSE) {
      $bytes = fread($hRand, $count);
      fclose($hRand);
    }

    if(strlen($bytes) < $count) {
      $bytes = '';

      if($this->randomState === null) {
        $this->randomState = microtime();
        if(function_exists('getmypid')) {
          $this->randomState .= getmypid();
        }
      }

      for($i = 0; $i < $count; $i += 16) {
        $this->randomState = md5(microtime() . $this->randomState);

        if (PHP_VERSION >= '5') {
          $bytes .= md5($this->randomState, true);
        } else {
          $bytes .= pack('H*', md5($this->randomState));
        }
      }

      $bytes = substr($bytes, 0, $count);
    }

    return $bytes;
  }

  private function encodeBytes($input) {
    // The following is code from the PHP Password Hashing Framework
    $itoa64 = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    $output = '';
    $i = 0;
    do {
      $c1 = ord($input[$i++]);
      $output .= $itoa64[$c1 >> 2];
      $c1 = ($c1 & 0x03) << 4;
      if ($i >= 16) {
        $output .= $itoa64[$c1];
        break;
      }

      $c2 = ord($input[$i++]);
      $c1 |= $c2 >> 4;
      $output .= $itoa64[$c1];
      $c1 = ($c2 & 0x0f) << 2;

      $c2 = ord($input[$i++]);
      $c1 |= $c2 >> 6;
      $output .= $itoa64[$c1];
      $output .= $itoa64[$c2 & 0x3f];
    } while (1);

    return $output;
  }

  /*
  $bcrypt = new Bcrypt(15);
  $hash = $bcrypt->hash('password');
  $isGood = $bcrypt->verify('password', $hash);
  */
}



#echo "Classes Initialized <br />";
?>