<html>
<head>
<link rel="stylesheet" href="styles.css" />
<script type="text/javascript" src="scripts.js"></script>
<script src="RGraph.common.core.js"></script>

<script src="RGraph.common.adjusting.js"></script> <!-- Just needed for adjusting -->
<script src="RGraph.common.annotate.js"></script>  <!-- Just needed for annotating -->
<script src="RGraph.common.context.js"></script>   <!-- Just needed for context menus -->
<script src="RGraph.common.effects.js"></script>   <!-- Just needed for visual effects -->
<script src="RGraph.common.resizing.js"></script>  <!-- Just needed for resizing -->
<script src="RGraph.common.tooltips.js"></script>  <!-- Just needed for tooltips -->
<script src="RGraph.common.zoom.js"></script>      <!-- Just needed for zoom -->

<script src="RGraph.bar.js"></script>              <!-- Just needed for bar charts -->
<script src="RGraph.bipolar.js"></script>          <!-- Just needed for bi-polar charts -->
<script src="RGraph.fuel.js"></script>             <!-- Just needed for fuel charts -->
<script src="RGraph.funnel.js"></script>           <!-- Just needed for funnel charts -->
<script src="RGraph.gantt.js"></script>            <!-- Just needed for gantt charts -->
<script src="RGraph.gauge.js"></script>            <!-- Just needed for gauge charts -->
<script src="RGraph.hbar.js"></script>             <!-- Just needed for horizontal bar charts -->
<script src="RGraph.hprogress.js"></script>        <!-- Just needed for horizontal progress bars -->
<script src="RGraph.led.js"></script>              <!-- Just needed for LED charts -->
<script src="RGraph.line.js"></script>             <!-- Just needed for line charts -->
<script src="RGraph.meter.js"></script>            <!-- Just needed for meter charts -->
<script src="RGraph.odo.js"></script>              <!-- Just needed for odometers -->
<script src="RGraph.pie.js"></script>              <!-- Just needed for pie AND donut charts -->
<script src="RGraph.radar.js"></script>            <!-- Just needed for radar charts -->
<script src="RGraph.rose.js"></script>             <!-- Just needed for rose charts -->
<script src="RGraph.rscatter.js"></script>         <!-- Just needed for rscatter charts -->
<script src="RGraph.scatter.js"></script>          <!-- Just needed for scatter charts -->
<script src="RGraph.thermometer.js"></script>      <!-- Just needed for thermometer charts -->
<script src="RGraph.vprogress.js"></script>        <!-- Just needed for vertical progress bars -->
<script src="RGraph.waterfall.js"></script>        <!-- Just needed for waterfall charts  -->

<style type="text/css">
div { margin:.5%; }
table, tr, td {
color:#fff;
font-size:14;
}
td input {
width:90px;
}

body {
	background-color: #333;
	text-align: center;
}
</style>
</head>
<body>
<?php
$server = "dbztech.com:3306";
$username = "frcScoreUser"; 
$password = "921550024Er!";
$link = @mysql_connect ($server, $username, $password) or die (mysql_error()); 
if (!@mysql_select_db("frcscores", $link)) {    
     echo "<p>There has been an error. This is the error message:</p>"; 
     echo "<p><strong>" . mysql_error() . "</strong></p>"; 
     echo "Please Contact Your Systems Administrator with the details"; 
}

echo '<form action="analytics2012.php" mathod="get">
<select name="event">';
$sql = "SHOW TABLES FROM `frcscores`";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list events<br />";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) { echo "<option>{$row[0]}</option>"; }
echo '</select>
<input type="submit" />
</form>';



################
#GRAPH SOFTWARE#
################

$match = $_GET['match'];
$event = $_GET['event'];
$team = $_GET['team'];

if (!(isset($match)) && !(isset($event)) && !(isset($team))) {
	#############
	##ALL TEAMS##
	#############
	echo "<p>Analytics for the 2012 season:</p>";
	$column = array();

	$query = mysql_query("SELECT * FROM `allevents`");
	if (!$query) {
    	die('Invalid query: ' . mysql_error());
	}
	while($row = mysql_fetch_array($query)){
    	$redscore[] = $row['redscore'];
    	$bluescore[] = $row['bluescore'];
    	$bluebridge[] = $row['bluebridge'];
    	$redbridge[] = $row['redbridge'];
	}
	$games = count($redscore);




	############
	###SCORES###
	############




	$outputString = "[";
	for ($i=0; $i < $games; $i++) { 
		if ($i==0) {
			$outputString = $outputString.$redscore[$i];
		} else {
			$outputString = $outputString.", ".$redscore[$i];
		}
	}
	
	$outputStringBlue = "[";
	for ($i=0; $i < $games; $i++) { 
		if ($i==0) {
			$outputStringBlue = $outputStringBlue.$bluescore[$i];
		} else {
			$outputStringBlue = $outputStringBlue.", ".$bluescore[$i];
		}
	}
	
	$outputStringBlue = $outputStringBlue."]";
	$outputString = $outputString."]";
	#echo $outputString;
	#echo $outputStringBlue;



	##################
	###DONUT GRAPHS###
	##################
	$bridgeinvolved = 0;
	$bridgevictory = 0;
	$bothbridges = 0;
	$redwin = 0;
	$bluewin = 0;
	$tie = 0;
	
	for ($i=0; $i < $games; $i++) { 
		if ($bluebridge[$i]>0 xor $redbridge[$i]>0) {
			$bridgeinvolved++;
			if ($redbridge[$i]>0 && $redscore[$i]>$bluescore[$i]) {
				$bridgevictory++;
			}
			if ($bluebridge[$i]>0 && $redscore[$i]<$bluescore[$i]) {
				$bridgevictory++;
			}
		}
		if ($bluebridge[$i]>0 && $redbridge[$i]>0) {
			$bothbridges++;
		}
		if ($redscore[$i]>$bluescore[$i]) {
			$redwin++;
		}
		elseif ($redscore[$i]<$bluescore[$i]) {
			$bluewin++;
		}
		else { $tie++; }
	}
	$bridgeless = $games-$bridgeinvolved;
	$bridgeloss = $bridgeinvolved-$bridgevictory;
	$bridgelessvictory = $games-$bridgevictory;
	$bridges = $bridgeless - $bothbridges;
	
	$outputStringBridge = "[".$bridges.", ".$bridgeless."]";
	
	$outputStringBridgeVictory = "[".$bridgevictory.", ".$bridgeloss.", ".$bridgeless.", ".$bothbridges."]";

	$outputStringWins = "[".(100*$redwin/$games).", ".(100*$bluewin/$games).", ".(100*$tie/$games)."]";

	#echo $outputStringBridgeVictory;
	#echo $outputStringWins;




	echo "<script>
    window.onload = function ()
    {
        var scorered = ".$outputString.";
        var scoreblue = ".$outputStringBlue.";

        // Create the Line chart object. The arguments are the canvas ID and the data array.
        var scoreovertime = new RGraph.Line('scoreovertime', scorered, scoreblue);
        
        // The way to specify multiple lines is by giving multiple arrays, like this:
        //var line = new RGraph.Line('myLine', [4,6,8], [8,4,6], [4,5,3]);
        
        // Configure the chart to appear as you wish.
        scoreovertime.Set('chart.background.barcolor1', 'white');
        scoreovertime.Set('chart.background.barcolor2', 'white');
        scoreovertime.Set('chart.background.grid.color', 'rgba(238,238,238,1)');
        scoreovertime.Set('chart.colors', ['red','blue']);
        scoreovertime.Set('chart.linewidth', 2);
        scoreovertime.Set('chart.filled', false);
        scoreovertime.Set('chart.hmargin', 5);
        //line.Set('chart.labels', ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        scoreovertime.Set('chart.gutter.left', 40);
        scoreovertime.Set('chart.text.color', 'white');
        
        // Now call the .Draw() method to draw the chart.
        scoreovertime.Draw();







        // The data to be shown on the Donut chart
        var bridgeuseddata = ".$outputStringBridge.";
    
        // Create the Donut chart (which is really a Pie chart).
        var bridgeused = new RGraph.Pie('bridgeused', bridgeuseddata);
        
        // Configure the Donut chart to look as wanted.
        bridgeused.Set('chart.labels', ['Used and Won', 'Not Used']);
        bridgeused.Set('chart.linewidth', 5);
        bridgeused.Set('chart.strokestyle', 'white');
        bridgeused.Set('chart.tooltips', ['Matches that have used the bridge', 'Matches that ave not used the bridge']);
        bridgeused.Set('chart.text.color', 'white');
        
        // Specify the variant, which turns the Pie chart into a Donut chart.
        bridgeused.Set('chart.variant', 'donut');
        
        // Call the .Draw() method to draw the Donut chart
        bridgeused.Draw();

        // The data to be shown on the Donut chart
        var bridgewindata = ".$outputStringBridgeVictory.";
    
        // Create the Donut chart (which is really a Pie chart).
        var bridgewin = new RGraph.Pie('bridgewin', bridgewindata);
        
        // Configure the Donut chart to look as wanted.
        bridgewin.Set('chart.labels', ['Used', 'Used But Lost', 'Not Used', 'Both Used']);
        bridgewin.Set('chart.linewidth', 5);
        bridgewin.Set('chart.strokestyle', 'white');
        bridgewin.Set('chart.tooltips', ['Matches that have used the bridge and won', 'Matches that have used the bridge and lost', 'Matches that have not used the bridge', 'Matches in which both Alliances used the bridge']);
        bridgewin.Set('chart.text.color', 'white');
        
        // Specify the variant, which turns the Pie chart into a Donut chart.
        bridgewin.Set('chart.variant', 'donut');
        
        // Call the .Draw() method to draw the Donut chart
        bridgewin.Draw();
        
        
        
        var winuseddata = ".$outputStringWins.";
        var bar = new RGraph.Bar('alliwin', winuseddata);
          
        // Now configure the chart to appear as wanted by using the .Set() method.
        // All available properties are listed below.
        bar.Set('chart.labels', ['Red Won', 'Blue Won', 'Tied']);
        bar.Set('chart.gutter.left', 45);
        bar.Set('chart.background.barcolor1', 'white');
        bar.Set('chart.background.barcolor2', 'white');
        bar.Set('chart.background.grid', true);
        bar.Set('chart.colors', ['red', 'blue', 'grey']);
        bar.Set('chart.text.color', 'white');
        
        // Now call the .Draw() method to draw the chart
        bar.Draw();  
        
        
    }
</script>";
	echo "<p>Score over time:</p>";
	echo '<canvas id="scoreovertime" width="650" height="400">[No canvas support]</canvas>';
	echo "<p>Matches that used bridges:</p>";
	echo '<canvas id="bridgeused" width="650" height="400">[No canvas support]</canvas>';
	echo "<p>Matches that used bridges and won:</p>";
	echo '<canvas id="bridgewin" width="650" height="400">[No canvas support]</canvas>';
	echo "<p>Alliance Wins:</p>";
	echo '<canvas id="alliwin" width="650" height="400">[No canvas support]</canvas>';
	
	echo "<br />".$outputStringWins;
	
} 




else {
		echo "<p>Analytics for the 2012 season ".$event." event:</p>";
	$column = array();

	$query = mysql_query("SELECT * FROM `".$event."`");
	if (!$query) {
    	die('Invalid query: ' . mysql_error());
	}
while($row = mysql_fetch_array($query)){
    	$redscore[] = $row['redscore'];
    	$bluescore[] = $row['bluescore'];
    	$bluebridge[] = $row['bluebridge'];
    	$redbridge[] = $row['redbridge'];
	}
	$games = count($redscore);




	############
	###SCORES###
	############




	$outputString = "[";
	for ($i=0; $i < $games; $i++) { 
		if ($i==0) {
			$outputString = $outputString.$redscore[$i];
		} else {
			$outputString = $outputString.", ".$redscore[$i];
		}
	}
	
	$outputStringBlue = "[";
	for ($i=0; $i < $games; $i++) { 
		if ($i==0) {
			$outputStringBlue = $outputStringBlue.$bluescore[$i];
		} else {
			$outputStringBlue = $outputStringBlue.", ".$bluescore[$i];
		}
	}
	
	$outputStringBlue = $outputStringBlue."]";
	$outputString = $outputString."]";
	#echo $outputString;
	#echo $outputStringBlue;



	##################
	###DONUT GRAPHS###
	##################
	$bridgeinvolved = 0;
	$bridgevictory = 0;
	$bothbridges = 0;
	$redwin = 0;
	$bluewin = 0;
	$tie = 0;
	
	for ($i=0; $i < $games; $i++) { 
		if ($bluebridge[$i]>0 xor $redbridge[$i]>0) {
			$bridgeinvolved++;
			if ($redbridge[$i]>0 && $redscore[$i]>$bluescore[$i]) {
				$bridgevictory++;
			}
			if ($bluebridge[$i]>0 && $redscore[$i]<$bluescore[$i]) {
				$bridgevictory++;
			}
		}
		if ($bluebridge[$i]>0 && $redbridge[$i]>0) {
			$bothbridges++;
		}
		if ($redscore[$i]>$bluescore[$i]) {
			$redwin++;
		}
		elseif ($redscore[$i]<$bluescore[$i]) {
			$bluewin++;
		}
		else { $tie++; }
	}
	$bridgeless = $games-$bridgeinvolved;
	$bridgeloss = $bridgeinvolved-$bridgevictory;
	$bridgelessvictory = $games-$bridgevictory;
	$bridges = $bridgeless - $bothbridges;
	
	$outputStringBridge = "[".$bridges.", ".$bridgeless."]";
	
	$outputStringBridgeVictory = "[".$bridgevictory.", ".$bridgeloss.", ".$bridgeless.", ".$bothbridges."]";

	$outputStringWins = "[".(100*$redwin/$games).", ".(100*$bluewin/$games).", ".(100*$tie/$games)."]";

	#echo $outputStringBridgeVictory;
	#echo $outputStringWins;




	echo "<script>
    window.onload = function ()
    {
        var scorered = ".$outputString.";
        var scoreblue = ".$outputStringBlue.";

        // Create the Line chart object. The arguments are the canvas ID and the data array.
        var scoreovertime = new RGraph.Line('scoreovertime', scorered, scoreblue);
        
        // The way to specify multiple lines is by giving multiple arrays, like this:
        //var line = new RGraph.Line('myLine', [4,6,8], [8,4,6], [4,5,3]);
        
        // Configure the chart to appear as you wish.
        scoreovertime.Set('chart.background.barcolor1', 'white');
        scoreovertime.Set('chart.background.barcolor2', 'white');
        scoreovertime.Set('chart.background.grid.color', 'rgba(238,238,238,1)');
        scoreovertime.Set('chart.colors', ['red','blue']);
        scoreovertime.Set('chart.linewidth', 2);
        scoreovertime.Set('chart.filled', false);
        scoreovertime.Set('chart.hmargin', 5);
        //line.Set('chart.labels', ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        scoreovertime.Set('chart.gutter.left', 40);
        scoreovertime.Set('chart.text.color', 'white');
        
        // Now call the .Draw() method to draw the chart.
        scoreovertime.Draw();







        // The data to be shown on the Donut chart
        var bridgeuseddata = ".$outputStringBridge.";
    
        // Create the Donut chart (which is really a Pie chart).
        var bridgeused = new RGraph.Pie('bridgeused', bridgeuseddata);
        
        // Configure the Donut chart to look as wanted.
        bridgeused.Set('chart.labels', ['Used and Won', 'Not Used']);
        bridgeused.Set('chart.linewidth', 5);
        bridgeused.Set('chart.strokestyle', 'white');
        bridgeused.Set('chart.tooltips', ['Matches that have used the bridge', 'Matches that ave not used the bridge']);
        bridgeused.Set('chart.text.color', 'white');
        
        // Specify the variant, which turns the Pie chart into a Donut chart.
        bridgeused.Set('chart.variant', 'donut');
        
        // Call the .Draw() method to draw the Donut chart
        bridgeused.Draw();

        // The data to be shown on the Donut chart
        var bridgewindata = ".$outputStringBridgeVictory.";
    
        // Create the Donut chart (which is really a Pie chart).
        var bridgewin = new RGraph.Pie('bridgewin', bridgewindata);
        
        // Configure the Donut chart to look as wanted.
        bridgewin.Set('chart.labels', ['Used', 'Used But Lost', 'Not Used', 'Both Used']);
        bridgewin.Set('chart.linewidth', 5);
        bridgewin.Set('chart.strokestyle', 'white');
        bridgewin.Set('chart.tooltips', ['Matches that have used the bridge and won', 'Matches that have used the bridge and lost', 'Matches that have not used the bridge', 'Matches in which both Alliances used the bridge']);
        bridgewin.Set('chart.text.color', 'white');
        
        // Specify the variant, which turns the Pie chart into a Donut chart.
        bridgewin.Set('chart.variant', 'donut');
        
        // Call the .Draw() method to draw the Donut chart
        bridgewin.Draw();
        
        
        
        var winuseddata = ".$outputStringWins.";
        var bar = new RGraph.Bar('alliwin', winuseddata);
          
        // Now configure the chart to appear as wanted by using the .Set() method.
        // All available properties are listed below.
        bar.Set('chart.labels', ['Red Won', 'Blue Won', 'Tied']);
        bar.Set('chart.gutter.left', 45);
        bar.Set('chart.background.barcolor1', 'white');
        bar.Set('chart.background.barcolor2', 'white');
        bar.Set('chart.background.grid', true);
        bar.Set('chart.colors', ['red', 'blue', 'grey']);
        bar.Set('chart.text.color', 'white');
        
        // Now call the .Draw() method to draw the chart
        bar.Draw();  
        
        
    }
</script>";
	echo "<p>Score over time:</p>";
	echo '<canvas id="scoreovertime" width="650" height="400">[No canvas support]</canvas>';
	echo "<p>Matches that used bridges:</p>";
	echo '<canvas id="bridgeused" width="650" height="400">[No canvas support]</canvas>';
	echo "<p>Matches that used bridges and won:</p>";
	echo '<canvas id="bridgewin" width="650" height="400">[No canvas support]</canvas>';
	echo "<p>Alliance Wins:</p>";
	echo '<canvas id="alliwin" width="650" height="400">[No canvas support]</canvas>';
	
	echo "<br />".$outputStringWins;
	
}
?>

</body>
</html>