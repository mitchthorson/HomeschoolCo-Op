<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Code Generation</title>

<link rel='stylesheet' href='../../styles/admin.css'>
<!--Loading Typekit-->
<script type='text/javascript' src='//use.typekit.net/mfa0kpf.js'></script>
<script type='text/javascript'>try{Typekit.load();}catch(e){}</script>
</head>

<body class='download_admin'>
<header id="bar">
<div class="header_stuff">
<a href='/'>
<img id='logo' src='../../images/logo-yellow.svg' />
<h1 id='name'>Homeschool Co-op</h1>
</a>
</div>
</header>
<div class='admin_wrap'><?php
include("vars.php");
mysql_connect("$server", "$db_user","$db_pass") or
        die ("Could not connect to database");
mysql_select_db("$db_name") or
        die ("Could not select database");
?>
