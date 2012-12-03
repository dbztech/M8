<?php 
$headerstuff = NULL;
$pageTitle = "MPA Robotics - The Game";
include('header.php');
?>

<div id="content">

<img id="articleImg" src="/images/thegameheader.png" alt="The Game" />

<div id="title" class="swoosh" style=" background-size: 100%;">
<div id="frontswoosh">
<img src="/images/theteam.png" alt="The Team" class="titleimg" />
</div>
<h1 id="swooshtitle">The Game</h1>
</div>


<div class="contentblock" style="margin-top: 15px; height: 445px">
<iframe src="/videos/videoplay.php?id=game&amp;frameid=gamevideo" style="width: 100%; height: 435px; border: 0px; overflow: hidden">Sorry, Your browser is busted. Get a new one.</iframe>
</div>

<div id="gameDescription">
	<h1>Rebound Rumble</h1>
	<p>This years game comprises of two sets of teams, each with three robots. The arena consists of a 27ft. by 54ft.field with hoops on either end, a 4 inch "barrier" in the middle and three bridges that span this barrier. 
	<br /><br />The goal in Rebound Rumble is to score as many points as possible by firstly shooting a foam ball into one of three sets of hoops, located at 28, 61 and 98 inches high  and worth 1, 2 or 3 points respectively. Secondly, at the end of the match teams can score either "Coopertition" points by balancing on the center bridge with another robot of the opposing team, or they can attempt to balance multiple of their own robots for 10 points for one, 20 for two and 40 points for all three robots balancing at once.
	<br /><br />For the initial 15 seconds of the match there is a hybrid mode in which robots can be controlled either fully autonomously or controlled by a team member with an XBOX Kinect. During this time each basket made recieves an additional 3 points.
	</p>
	
	<h3 style="margin-bottom: -10px;">Summary:</h3>
	<p>Make a robot that plays backetball!</p>
</div>

</div>
<?php 
$footerstuff = NULL;
include('footer.php');
?>
