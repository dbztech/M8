<?php 
$headerstuff = "<style type='text/css'>p {margin:20px;}</style>";
$pageTitle = "MPA Robotics - 404";
include('header.php');
?>

<div id="content">
<br />
<h2>Try Again</h2>
<p>You've tried to access a page that doesn't exist.</p>
<p>As the site is still under construction, some pages may not yet exist. Please do not panic, and check back soon for updates.</p>
<p>If you are typing random URLs stop it.</p>
<p>And yes, in case you were wondering, this is a 404.</p>


<div style="display: none">
<?php 
include('debug.php');
echo '</div></div>';
$footerstuff = NULL;
include('footer.php');
?>
