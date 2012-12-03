<?php
#Classes File

class useragent
{
	public $iphone = "/iPhone/";
	public $ipad = "/iPad/";
	public $androidphone = "/android/";
	public $androidtablet = "/android/";
	public $ie = "/Trident/";
	
	public function checkua($scrubber) {
		$browser = $_SERVER['HTTP_USER_AGENT'];
		preg_match($scrubber,$browser, $result);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}
	
	public function ismobile() {
		return $this->checkua($this->iphone);
	}
	
	public function checkie() {
		return $this->checkua($this->ie);
	}
}


$uacheck = new useragent();
?>