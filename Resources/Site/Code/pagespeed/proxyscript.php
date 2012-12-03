<?php
$jsonInput = file_get_contents('https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=http://code.google.com/speed/page-speed/&key=AIzaSyAXvwpKRDm5FjNr-do4n0F2sh9ZcNYTPtk');
$jsonArray = json_decode($jsonInput, true);
print_r($jsonArray);
/*	
function output($fh1){
foreach($fh1 as $key => $value){
		for ($i=0; $i < substr_count($value, "{"); $i++)
			$shift .= "\t";
		for ($i=0; $i < substr_count($value, "}"); $i++)
			$shift = substr($shift, 2);
		echo $shift . $value . "\n";

	}
}	


$shift = "";
$fhc = readfile('https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=http://code.google.com/speed/page-speed/&key=AIzaSyAXvwpKRDm5FjNr-do4n0F2sh9ZcNYTPtk');
$fh1 = explode(": ", $fhc);
//foreach($fh1 as $key => $value){
//	$fh1[$key] = func1($value);
//	}
output($fh1);	

//print_r($fh1);
*/
?>
