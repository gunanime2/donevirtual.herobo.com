<! DOCTYPE HTML>
<html>
<title><?php echo $title." - Done Virtual";?></title>
<head>
	<?php 
	require('/css/style_2.css');
	//require('application/views/script/script2.js');
	?>
	<!--fiddle source url:http://jsfiddle.net/wV6Tk/-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script>
$(function(){
     function fadeMyContent() {
         
         $(".slide_content:first").fadeIn(200).delay(4000).fadeOut(200,
             function() {    
                     $(this).appendTo($(this).parent());   
                     fadeMyContent();    
             });
      }
     fadeMyContent();
});
</script>

<script>
$(function(){
     function fadeMyContent() {
         
         $(".slide_content_recent:first").fadeIn(200).delay(4000).fadeOut(200,
             function() {    
                     $(this).appendTo($(this).parent());   
                     fadeMyContent();    
             });
      }
     fadeMyContent();
});
</script>  

</head>
<body id="statements_body">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div id="container">

<div id="header">
<img id="header_img" src="http://localhost/donevirtual.com/images/dv_3.png"></img>
</br>
<!--
<b>Switch to:
	<a href="<?php echo base_url();?>"> Virtual Deeds</a>
	|<a href="#"> Virtual Statements</a>
</b>
-->
</br>
<div id="nav_bar">
	<a class="nav" href="<?php echo base_url();?>statements">Home</a>
	<a class="nav" href="<?php echo base_url(); ?>statements/say">Post Statement</a>
	<a class="nav" href="<?php echo base_url(); ?>statements/most_popular">Most Popular</a>
	<a class="nav" href="<?php echo base_url(); ?>statements/most_recent">Most Recent</a>
	<a class="nav" href="<?php echo base_url(); ?>#">Contact Us</a>
	<a class="nav" href="<?php echo base_url(); ?>statements/about">About Us</a>
</div>	
</div> <!--header end-->