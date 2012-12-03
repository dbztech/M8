<?php 
$headerstuff = NULL;
$pageTitle = "MPA Robotics - Contact";
include('header.php');
?>

<div id="content" style="text-align:center;">

<div id="title">

<h1>Contact MPA Robotics</h1>
<hr />
</div>
<br />
<?php if ($_POST[name] == NULL) {
echo('
<form action="../Contact" name="contact" method="post">
<div style="margin:auto;background:rgba(200,50,50,.5);opacity:50%;border-radius:10px;padding:10px;width: 141px;border:2px solid black; position: relative; right: 280px; top: 25px;">
Name:&nbsp;<input type="text" name="name" required="required" />
</div>


<div style="margin:auto;background:rgba(250,50,250,.5);opacity:50%;border-radius:10px;padding:10px;width: 190px;border:2px solid black; position: relative; top: -25px; left: -5px;">
Email:&nbsp;<input type="email" name="email" required="required" />
</div>

<div style="margin:auto;background:rgba(250,250,50,.5);opacity:50%;border-radius:10px;padding:10px;width: 600px;border:2px solid black; position: relative; left: -30px;">
Message:<br /><textarea name="message" required="required" rows="10" cols="80"></textarea>
</div>

<br />
<div style="margin:auto;background:rgba(100,200,50,.5);opacity:50%;border-radius:10px;padding:10px;width:60px;border:2px solid black; float: right; position: relative; top: -120px; left: -40px;">
<input type="submit" value="Submit" />
</div>
</form>
<br />
<hr style="width:98%;" />
<br />
<div style="margin:auto;background:rgba(50,0,150,.5);opacity:50%;border-radius:10px;padding:10px;border:2px solid black;color:white;width:400px;">
Address:<br />
Mounds Park Academy <br />
2051 Larpenteur Ave. E. <br />
Saint Paul, MN 55109 <br />
<br />
Phone: 651-777-2555
<br />
Eventually, more contact info (like an email address) will be posted here when it becomes available.
</div>
<br />');
}
else {
mail('colson13@moundsparkacademy.org','MPA Robotics mail from '.$_POST[name],wordwrap($_POST[message], 70),'From: '.$_POST[email]);
echo('<p style="color:white;">Your message has been sent.</p>'); 
}
?>

</div>
<?php 
$footerstuff = NULL;
include('footer.php');
?>