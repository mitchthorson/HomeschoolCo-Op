<?php include('admin/header.php'); 

if ($_GET['function'] != 'download'){
echo "<html>
<head>
<link rel='stylesheet' type='text/css' href='../styles/style.css'>
<meta name='viewport' content='width=device-width,minimum-scale=1.0,initial-scale=1,'>
<script type='text/javascript' src='//use.typekit.net/mfa0kpf.js'></script>
<script type='text/javascript'>try{Typekit.load();}catch(e){}</script>
<script type='text/javascript' src='../js/jquery.superLabels.min.js'></script>
</head>
<body id='download_page'>
<div id='wrapper'><header>
	<div class='header_stuff'>
	<a href='/'>
	<img id='logo' src='../images/logo-yellow.svg' />
	<h1 id='name'>Homeschool Co-op</h1>
	</a>
	</div>
	</header>
	<div id='dload_content'>";
}

$code = $_GET['code']; 



if (!isset($_GET["function"])){ //as in, if no function has been specified yet..

//check to make sure code entered is valid


$sql = mysql_query("SELECT * FROM album 
WHERE downloadCode = '$code'");
$result = mysql_num_rows($sql); 



if($result == 0 ) {
    echo "<h1><center>Oops!</center></h1>" . $code . "<h3>is not a valid code. Head over  <a href='../download/'>here</a> to try again!</h3></div>";
}

if($result != 0){
    echo "<h3>" . $code . " is a valid code.";
} 

//check for remaining downloads
while($row = mysql_fetch_array($sql))
	{
	echo "You can download the album up to " . $row['downloadsRemaining'] . " more times.</h3>";
	if($row['downloadsRemaining'] > 0){
		echo "<h3>Click to download below, or save this exact page to download later.</p></h3><p class='mobile-instuctions'>Unfortunately, downloading isn't supported on mobile devices, so you'll want to save this exact page and try from a computer!</p>
		<form action='download.php?function=download&code=$code' method='POST'><input class='download_button' name='download' type='submit' value='download' /></form><p></div>";
		}
	elseif($row['downloadsRemaining'] == 0){
		echo "<h2>Sorry, you don't have any more available downloads!</h2></div>";
		}
	}
}
elseif ($_GET["function"] == 'download'){
 	$code = $_GET['code']; 

//	$sql2 = "UPDATE `album` SET `downloadsRemaining` = `downloadsRemaining`-1 WHERE downloadCode = \'" . $code . "\'";
//$sql = 'UPDATE `album` SET `downloadsRemaining` = `downloadsRemaining`-1 WHERE downloadCode = \'abc123\'';
$sql = "UPDATE `album` SET `downloadsRemaining` = `downloadsRemaining`-1 WHERE downloadCode = '$code'";
$result = mysql_query("$sql"); 

$sql = "UPDATE `totals` SET `downloads` = `downloads`+1 WHERE album = 'album'";
$result = mysql_query("$sql"); 


$dir="files/";
$filename="Homeschool_CoOp.zip";
    $file=$dir.$filename;
    header("Content-type: application/zip");
    header("Content-Transfer-Encoding: Binary");
    header("Content-length: ".filesize($file));
    header("Content-disposition: attachment; filename=\"".basename($file)."\"");
    readfile("$file");
}
echo "<footer id='download_footer'>
<div id='copyright'>
<p>&copy;2013 Homeschool Co-op</p>
</div>
<div id='social'>
<ul>
<li><a href='https://twitter.com/homeschoolco_op' target='_blank'><img src='../images/twitter.svg' alt=''></a></li>
<li><a href='https://www.facebook.com/pages/Homeschool-Co-op/324753347646507' target='_blank'><img src='../images/fbook.svg' alt=''></a></li>
</ul>
</div>
</footer>"
?>
