

<div id="social">
<!--fb share-->

<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $post_item['positive']." click(s) said YES and ".$post_item['negative']." said NO to this post about ".ucfirst($post_item['subject']).".";?>&amp;p[summary]=<?php echo word_limiter($post_item['statement'], 20);?>&amp;p[url]=<?php echo base_url()."view_statements/".$post_item['slug']; ?>&amp;&amp;p[images][0]=<?php echo $post_item['image_url'];?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><img style="float:left;" src="http://cdn3.iconfinder.com/data/icons/socialmediabookmark/buttons/facebook_button.png"></img></a>

<!--fb LIKE and fb COMMENTS-->
<div id="fb_like">
	<p>
	<script>
	document.write("<div class='fb-like' data-href='" + location.href +"' data-send='true' data-width='450' data-show-faces='true'></div>");
	</script>
	</p>
</div>

	<script>
	document.write("<div class='fb-comments' data-href='" + location.href +"' data-num-posts='2' data-width='400'></div>");
	</script>
</div>