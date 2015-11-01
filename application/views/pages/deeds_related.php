</br>
<div id="deeds_related">
	<div id="deeds_related_title">
		Related Deeds
	</div>
	<?php foreach ($post as $post_item): ?>
	<a class="normal_link" href="<?php echo base_url() ?>pages/<?php echo $post_item['slug'] ?>">
	</br>
	<?php echo $post_item['subject'] ?> got a <?php echo $post_item['action']." in the ".$post_item['setting']." ".$post_item['hits']." time(s)."; ?>
	</a>
	</br>
	Views: <?php echo $post_item['views']?>
	<?php endforeach ?>
</div>