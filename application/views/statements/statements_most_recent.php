<div class="box" id="statements_most_recent">
	<div class="links_title">
		Most Recent Statements
	</div>

	<?php foreach($post as $post_item): ?>
		<a class="normal_links" href="<?php echo base_url()?>view_statements/<?php echo $post_item['slug'];?>">
		To <b><?php echo $post_item['subject']; ?></b>, </br> <img class='links_image' src="<?php echo $post_item['image_url']; ?>" title="<?php echo $post_item['subject']; ?>"> </img> </br><?php echo word_limiter($post_item['statement'], 10); ?> Views: <?php echo $post_item['views']; ?>
		</a>
		| <?php echo $post_item['date'];?>
		<hr>
	<?php endforeach?>
</div>
</div> <!--end links-->
