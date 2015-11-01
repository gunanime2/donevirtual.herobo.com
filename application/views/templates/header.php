<!DOCTYPE HTML>
<html>
	<title><?php echo $title ?> - Done Virtual</title>
<head>
	<?php require('application/views/css/style.css') ?>
</head>
<body id="main_body">
<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
-->
<div id="container">

<div id="header">
<img id="header_img" src="http://localhost/donevirtual.com/images/dv_3.png"></img>
</br>
<div id="site_links">Switch to:
	<a class="nav_link" href="#"> Virtual Deeds</a>
	|<a class="nav_link" href="<?php echo base_url();?>statements"> Virtual Statements</a>
</div>
</br>
<div id="page_links">
	<a class="nav_link" href="<?php echo base_url() ?>"> home</a>	
	|<a class="nav_link" href="<?php echo base_url() ?>post"> post deed</a>
	|<a class="nav_link" href="<?php echo base_url() ?>about"> about</a>
</div>
</div> <!--header end-->