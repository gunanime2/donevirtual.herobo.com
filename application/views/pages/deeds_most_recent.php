<div id="deeds_most_recent">
	<div id="most_recent_title">
		Most Recent Deeds
	</div>
	<?php foreach ($post as $post_item): ?>
	<a class="normal_link" href="<?php echo base_url() ?>pages/<?php echo $post_item['slug'] ?>">
	</br>
	<?php echo $post_item['subject'] ?> got a <?php echo $post_item['action']." in the ".$post_item['setting']." ".$post_item['hits']." time(s)."; ?>
	</a>
	</br>
	Date Posted: <?php echo $post_item['date'];?>
	<?php endforeach ?>
</div>
</div> <!--end div internal_links-->


<!--fb share-->
<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $post_item['subject']." got a ".$post_item['action']." in the ".$post_item['setting'];?>&amp;p[summary]=<?php echo $post_item['subject']." got a ".$post_item['action']." in the ".$post_item['setting']." ".$post_item['hits']." time(s). Join here! and ".$post_item['action']." ".$post_item['subject']." in the ".$post_item['setting']." too!";?>&amp;p[url]=<?php echo base_url().$post_item['slug']; ?>&amp;&amp;p[images][0]=<?php echo $post_item['image_url'];?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><img src="http://cdn3.iconfinder.com/data/icons/socialmediabookmark/buttons/facebook_button.png"></img></a>

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