<?php
#This is the basic M8 classes file

class m8
{
	public static $version = "b0.0.3";
	
	public static function variable($id) {
		echo variable::getvariable($id);
	}
	
	public static function title() {
		#echo "Yay";
		echo page::gettitle();
	}
	
	public static function description() {
        echo '<meta name="description" content="'.page::getdesc().'">';
	}
}

class lowlevel
{
	public static function header($msg) {
		header($msg);
        echo $msg;
	}
    
    public static function redirect($page) {
        #Send riderect header
        lowlevel::header("Location: ".$page);
    }
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

	public static function setcredentials($user, $password, $host = '127.0.0.1', $db = 'm8db', $pre = 'meight') {
    	// property declaration
    	$result = 'Credential(s) not set: ';
    	$error = 0;
    	if (is_string($user)) {
	    	database::$dbuser = $user;
	    } else {
    		$error = 1;
    		$result .= '$dbuser ';
    	}
    	
    	if (is_string($password)) {
	    	database::$dbpassword = $password;
	    } else {
    		$error = 1;
    		$result .= '$dbpassword ';
    	}
    	
    	if (!$error) {
    		database::$dbhost = $host;
    		database::$database = $db;
    		database::$prefix = $pre;
	    	$result = 'Success!';
	    } else {
	    	$result = 'Error!';
	    }

    	return $result;
    }
    
    public static function sqlconn() {	
		try {
    		$dbh = new PDO('mysql:host='.database::$dbhost.';dbname='.database::$database, database::$dbuser, database::$dbpassword);
    	}
    	catch (PDOException $e) {
			print ("Could not connect to server.\n");
			die ("getMessage(): " . $e->getMessage () . "\n");
		}
		return $dbh;
	}
	
    // method declaration
    public static function info() {
    	echo "Database: ".database::$database."<br />";
        echo "Database User: ".database::$dbuser."<br />";
        echo "Database Host: ".database::$dbhost."<br />";
        echo "Database Prefix: ".database::$prefix."<br />";
    }

    public static function test() {
    	$dbh = database::sqlconn();
    	if ($dbh) {
    		return true;
    		$dbh = NULL;
    	}
    	else {
    		return false;
    	}
    }

    public static function returndata($query) {
    	$dbh = database::sqlconn();

		// Perform Query
		$result = $dbh->query ($query);
	
	
		while ($row = $result->fetch()) {
		    return($row);
		}

		$dbh = NULL;
    }

    public static function returnmultiplerows($query) {
    	$dbh = database::sqlconn();

		$result = $dbh->query ($query);

		return $result;

		$dbh = NULL;
    }

    public static function writedata($query) {
    	$dbh = database::sqlconn();

		// Perform Query
		try {
			$result = $dbh->exec ($query);
		}

		// Check result
		// This shows the actual query sent to MySQL, and the error. Useful for debugging.
  		catch (PDOException $e) {
			print ("Could not connect to server.\n");
			die ("getMessage(): " . $e->getMessage () . "\n");
		}
		
		return("Query Successful");

		$dbh = NULL;
    }
}

class page
{
	//property declaration
	public static $location = "index.php";

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

	public static function gettitle() {
		$result = database::returndata('SELECT * FROM `pages` WHERE `location` = "'.page::$location.'"');
		return $result['title'];
	}

	public static function getdesc() {
		$result = database::returndata('SELECT * FROM `pages` WHERE `location` = "'.page::$location.'"');
		return $result['description'];
	}

	public function getallpages() {
		echo "<th>Page Name:</th><th>Page Title:</th><th>Page Description:</th><th>Page Location:</th>";
		$result = database::returnmultiplerows('SELECT * FROM `pages` ORDER BY `pages`.`title` ASC');
		$pass = 0;
		while ($row = $result->fetch()) {
			$pass++;
		    echo "<tr>";
		    echo '<td><input type="text" id="'.$row['id'].'name'.'" value="'.$row['name'].'" onblur="Page.write('.$row['id'].', 0'.');" disabled /></td>';
		    echo '<td><input type="text" id="'.$row['id'].'title'.'" value="'.$row['title'].'" onblur="Page.write('.$row['id'].', 1'.');" /></td>';
		    echo '<td><input type="text" id="'.$row['id'].'description'.'" value="'.$row['description'].'" onblur="Page.write('.$row['id'].', 2'.');" /></td>';
		    echo '<td><input type="text" id="'.$row['id'].'location'.'" value="'.$row['location'].'" onblur="Page.write('.$row['id'].', 3'.');" disabled /></td>';
			echo '<td><input type="button" id="'.$row['id'].'remove'.'" value="X" onclick="Page.remove('.$row['id'].');" /></td>';
		    echo "</tr>";
		}
	}
    
    public static function devmode() {
        #lowlevel::redirect($row['devredirect']);
        $result = database::returndata('SELECT * FROM `pages` WHERE `location` = "'.page::$location.'"');
        if ($result['devredirect']) {
            lowlevel::redirect($result['devredirect']);
        }
	}
}

class variable
{
	#0 = Number (Long)
	#1 = Text (String)
	#2 = Location (Filesystem)
	#3 = Zone (HTML)
	#4 = Boolean (Bool)

	public static function getvariable($name) {
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
		echo "<th>Variable Name:</th><th>Variable Value:</th>";
		$result = database::returnmultiplerows('SELECT * FROM `variables` ORDER BY `variables`.`name` ASC');
		$pass = 0;
		while ($row = $result->fetch()) {
			$pass++;
		    echo "<tr>";
		    echo '<td><input type="text" id="'.$row['id'].'varname'.'" value="'.$row['name'].'" onblur="Variable.write('.$row['id'].');" /></td>';
		    echo '<td><input type="text" id="'.$row['id'].'varvalue'.'" value="'.$this->getvariable($row['name']).'" onblur="Variable.write('.$row['id'].');" onclick="Variable.enlarge('.$row['id'].');" /></td>';
			echo '<td><input type="button" id="'.$row['id'].'remove'.'" value="X" onclick="Variable.remove('.$row['id'].');" /></td>';
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
	
	public static function listdir($directory) {
		$directory = getcwd().$directory;
		$i = 0;
		if ($handle = opendir($directory)) {
			/* This is the correct way to loop over the directory. */
			while (false !== ($entry = readdir($handle))) {
				$output[$i] = $entry;
				$i++;
			}

			closedir($handle);
		}
		return $output;
	}
	
	public static function copy($oldFile, $newFile) {
		if (!copy($oldFile, $newFile)) {
			echo "failed to copy $file...\n";
		}
	}
	
	public static function backup($filename) {
		file::copy(getcwd().'/Resources/Core/'.$filename,getcwd().'/Resources/Core/backup/'.$filename);
	}
}

class login extends Bcrypt
{

	public $username;
	public $passwordplain;
	public $cookiesexist = false;
	public $cookiehash;
	public $userhash;
	public $sessionhash;


	public function checklogin() {
		$user = database::returndata('SELECT * FROM `users` WHERE `username` = "'.$this->username.'"');
		if ($this->verify($this->passwordplain, $user['hash'])) {
			$this->userhash = $this->hash(rand());
			return true;
		} else {
			return false;
		}
	}

	public function checkcookie() {
		if ($this->cookiesexist) {
			$user = database::returndata('SELECT * FROM `users` WHERE `username` = "'.$this->username.'"');
			#echo "Session: ".$sessionhashcookie."<br /> Username: ".$usernamecookie."<br /> Hash: ".$user['random'];
			if ($user['sessionhash'] == $this->cookiehash) {
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
			$this->sessionhash = md5($this->userhash);
			$query = "UPDATE `users` SET `sessionhash` = '".$this->sessionhash."' WHERE `username` = '".$this->username."';";
			#echo $query;
			database::writedata($query);
			#echo $this->sessionhash;
			#echo $this->username;
			setcookie("sessionhash", $this->sessionhash);
			setcookie("username", $this->username);
			return true;
		} else {
			return false;
		}
	}
	
	public function logout() {
		$query = "UPDATE `users` SET `sessionhash` = '".$this->hash(rand())."' WHERE `username` = '".$this->username."';";
		database::writedata($query);
	}

	public function createuser($username, $password, $level, $actuiallycreateuser) {
		$query = "INSERT INTO `users` (`username`, `hash`, `level`, `sessionhash`, `id`) VALUES ('".$username."', '".$this->hash($password)."', '0', '".$this->hash(rand())."', NULL);";
		if (database::returndata('SELECT * FROM `users` WHERE `users`.`username` = "'.$username.'"')) {
			echo "Already exists";
			$actuiallycreateuser = false;
		}
		if ($actuiallycreateuser) {
			database::writedata($query);
			echo "Created";
		} else {
			echo $query;
		}
	}
}

class patch
{
    public static $enabled;
    
	public static function verify() {
        if (patch::$enabled) {
            if (patch::getfiles()) {
                #echo "PATCHING";
                backup::patch();
                #Verify Patch
            }
        }
	}
	
	public static function apply() {
		patch::verify();
		#Update Files
		#Update Database
		patch::cleanup();
	}
	
	public static function cleanup() {
		#Delete patch files
		#Remove unnecesary files
	}
	
	public static function getfiles() {
		#Return an array of all the files to be patched
		$files = file::listdir('/Resources/Core/patch');
		$inew = 0;
		for($i = 2; $i <= count($files)-1; $i++) {
			$output[$inew] = $files[$i];
			$inew++;
		}
		return $output;
	}
}

class backup
{
	public static function database() {
		#Db to file
	}
	
	public static function content() {
		#Copy content to backup folder
	}
	
	public static function core() {
		#Copy core to backup folder
	}
	
	public static function patch() {
		$files = patch::getfiles();
		for($i = 0; $i <= count($files)-1; $i++) {
			file::backup($files[$i]);
		}
	}
}

class sanatize
{
	public static function login($input) {
		#First entry point
	}
	
	public static function general($input) {
		#Once logged in, general dont break shit with weird characters
	}
    
    public static function ajax($input) {
		#Verified execution, seceptable to injection
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