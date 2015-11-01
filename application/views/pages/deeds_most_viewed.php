</br>
<div id="internal_links">

<div id="deeds_most_viewed">
	<div id="most_viewed_title">
		Most Viewed Deeds
	</div>
	<?php foreach ($post as $post_item): ?>
	<a class="normal_link" href="<?php echo base_url() ?>pages/<?php echo $post_item['slug'] ?>">
	</br>
	<?php echo $post_item['subject'] ?> got a <?php echo $post_item['action']." in the ".$post_item['setting']." ".$post_item['hits']." time(s)."; ?>
	</a>
	</br>
	<?php endforeach ?>
</div>