<?php
	$to_crawl=$_POST["url"];
	$c = array();
	if(strcmp($to_crawl,"")==0){
		header('Location: http://localhost/Crawler/webcrawler.php');
	}
	if(substr($to_crawl,0,7)!="http://" && substr($to_crawl,0,8)!="https://"){
		if(substr($to_crawl,0,3)=="www"){
			$to_crawl="http://".substr($to_crawl,4);
		}
		else{
			$to_crawl="http://".$to_crawl;
		}
	}
	if(substr($to_crawl,0,7)=="http://" && substr($to_crawl,7,3)=="www"){
		$to_crawl="http://".substr($to_crawl,11);
	}
	else if(substr($to_crawl,0,8)=="https://" && substr($to_crawl,8,3)=="www"){
		$to_crawl="https://".substr($to_crawl,12);
	}
	function get_links($url){

		global $c;
		$ch=curl_init();
		$timeout=10;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$input=curl_exec($ch);
		curl_close($ch);
		
		if($input===FALSE){
			echo "Cannot access the URL";
		}
		$regex="<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		preg_match_all("/$regex/siU",$input,$matches);
		$base_url=parse_url($url,PHP_URL_HOST);
		$l=$matches[2];
		$fl=0;

		foreach($l as $link){
			if(strpos($link, "#") != FALSE ){
				$link=substr($link,0,strpos($link, "#"));
			}
			
			if(substr($link,0,1) == "."){
				$link=substr($link,1);
			}
			
			if(substr($link,0,7) == "http://"){
				$link=$link;
			}

			else if(substr($link,0,8) == "https://"){
				$link=$link;
			}
			
			else if(substr($link,0,2) == "//"){
				$link=substr($link,2);
			}
			
			else if(substr($link,0,1) == "#"){
				$link=$url;
			}

			else if(substr($link,0,7) == "mail:to"){
				$link="[".$link."]";
			}

			else{
				if(substr($link,0,1) != "/"){
					$link = $base_url."/".$link;
				}
				else{
					$link = $base_url.$link;
				}
			}
			
			if(substr($link,0,7) != "http://" && substr($link,0,8) != "https://" && substr($link,0,1) != "["){
				if(substr($link,0,8) == "https://"){
					$link="https://".$link;
				}
				else{
					$link="http://".$link;
				}
			}
			
			if(!in_array($link,$c)){
				array_push($c,$link);
			}
		}
	}

?>	

<!--Author : Sk. Shahir Halim-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Crawler</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="page-header" align="center"><h1>Crawler v0.1</h1></div>
<div class="page-header"><h4>URL : <?php echo $to_crawl; ?></h4></div>
<div class="well">
<ol>
<?php
	get_links($to_crawl);

	foreach($c as $page){
		get_links($page);
	}

	foreach($c as $page){
		echo '<li><a href="'.$page.'" target="_blank">'.$page.'</a>';
	}
?>
</ol>
</div>
<div class="row"><h5>Developed by Sk. Shahir Halim</h5></div>
</div>
</body>
</html>	
