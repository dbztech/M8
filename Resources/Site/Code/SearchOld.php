<?php 
$headerstuff = "<script src='http://www.google.com/jsapi' type='text/javascript'></script>
<script type='text/javascript'>
 google.load('search', '1', {language : 'en'});
 google.setOnLoadCallback(function() {
   var customSearchOptions = {};  var customSearchControl = new
google.search.CustomSearchControl(
     '012299787330224643000:7szzikmx44m', customSearchOptions);

customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
   customSearchControl.draw('cse');
 }, true);
</script>
<link rel='stylesheet'
href='http://www.google.com/cse/style/look/default.css' type='text/css' />

<style type='text/css'>.cse .gsc-control-cse, .gsc-control-cse {
	background:none;border:0px;padding:0em;
}

.gsc-control-cse .gsc-table-result {

background:#fff;border:0px;
}

.cse .gsc-webResult.gsc-result, .gsc-webResult.gsc-result, .gsc-imageResult-column, .gsc-imageResult-classic {

border:0px;
}

</style>
";
$pageTitle = "MPA Robotics - Search";
include('header.php');
flush();
?>

<div id="content">

<div id="cse" style="width: 100%; background: white;">Loading</div>

</div>
<?php 
$footerstuff = NULL;
include('footer.php');
?>
