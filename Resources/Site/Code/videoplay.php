<?php 
$headerstuff = NULL;
$pageTitle = "MPA Robotics - Video Player";
include('header.php');
?>

<div id="content">
<div class="contentblock" id="slide1" style="height: 450px; background: #111;">
<?php
$input = $_GET['input'];
$type = $_GET['type'];
echo "<br />";
echo '<iframe width="640" height="390" src="'.$input.'" frameborder="0" allowfullscreen></iframe>';
?>
</div>
<br />
</div>


<?php 
$footerstuff = NULL;
include('footer.php');
?>