<?php include('header.php'); ?>
<?php
print_r($database->returndata('SELECT * FROM `test` WHERE 1'));
?>
<?php include('leftnav.php'); ?>
<div id="splash"><img src="Resources/Site/Files/Continue.png" alt="Continue" id="splashcontinue" /><p id="splashtext">#M8</p></div>
<div id="content">
<p>Hello World</p>
</div>
<?php include('footer.php'); ?>