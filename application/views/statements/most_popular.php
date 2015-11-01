<div id="most_popular">
	<div class="links_title">
		Most Popular
	</div>
	<?php foreach ($post as $post_item): ?>
		<div class="most_popular_links">
			<a href="<?php echo base_url()?>view_statements/<?php echo $post_item['slug'];?>">
			To <b><?php echo $post_item['subject']; ?></b>, </br><img class='links_image' src="<?php echo $post_item['image_url']; ?>" alt="<?php echo $post_item['subject']; ?>" title="<?php echo "Statement to ".$post_item['subject']; ?>"> </img> </br><?php echo word_limiter($post_item['statement'], 5); ?></br> Views: <?php echo $post_item['views']; ?>
			</a>
		</div>
	<?php endforeach ?>

		<div id="most_popular_pagination_links">
			<?php echo $links; //pagination links?>
		</div>
</div>