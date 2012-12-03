<?php 
$headerstuff = NULL;
$pageTitle = "MPA Robotics - The Robot";
include('header.php');
?>

<div id="content" style="height: 600px">

    <div class="selectbar">
        <p>Select a year:</p>
        <p><a href="#">2012</a>|<a href="#">2013</a></p>
    </div>
    
    <div id="robotImage">
        <a href="#" class="node"></a>
    </div>
    
    <div id="robotContent">
        <div class="contentStatic">
            <h1>Title</h1>
            <h2>Subtitle</h2>
            <p>Content</p>
        </div>
        
        <div class="contentStub">
        </div>
    </div>
    
</div>
<?php 
$footerstuff = NULL;
include('footer.php');
?>