<!--Author : Sk. Shahir Halim-->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crawl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	
} 

$addr=$_SERVER['REMOTE_ADDR'];
$port=$_SERVER['REMOTE_PORT'];
$sql = "INSERT INTO visitor (Address,Port)
VALUES ('$addr','$port')";

if ($conn->query($sql) === TRUE) {

} 
else{
	
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Crawler</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		$("#crcl").click(function(){
			if($("#dataurl").val()=="")
				alert("URL cannot be blank")
			var $this = $(this);
			$this.button('loading');
			setTimeout(function() {
			$this.button('reset');
			}, 80000);
		});
	});
</script>
</head>
<body>
<div class="container">
<div class="page-header" align="center"><h1>Crawler v0.1</h1></div>
<div class="page-header"><h4>What</h4></div>
<div class="bg-warning" style="padding:10px">This Crawler browse through the entire given website and indexes all the accessible links in that website.</div>
<div class="page-header"><h4>How</h4></div>
<div class="bg-success" style="padding:10px">Give the full url/link of the website in Url Box <br>Or go to the website , copy the url and paste it in Url Box (Try google.com)<br>Press Crawl Button and Wait for Completion.</div>
<div class="page-header"><h4>Mention</h4></div>
<div class="bg-danger" style="padding:10px">This Crawler may not work with all websites (like facebook.com) where crawlers are not allowed.<br>This Crawler is just for Education purpose.</div>
<div class="row well" style="margin-top:15px;">
<form class="form-group" method="post" action="crawl.php">
<label for="url" class="col-sm-4 col-xs-4"><h4>URL</h4></label>
<div class="col-sm-8 col-xs-8"><input type="text" class="form-control" name="url" id="dataurl" placeholder="Url Box"></div>
<div class="row"><button type="submit" class="btn btn-primary col-sm-12 col-xs-12" id="crcl" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing ...">Crawl</button></div>
</form>
</div>
<div class="row"><h5>Developed by Sk. Shahir Halim</h5></div>
</div>
</body>
</html>

