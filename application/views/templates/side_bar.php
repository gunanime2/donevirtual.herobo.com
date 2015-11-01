<div class='side_bar'>
<?php foreach ($post as $post_item): ?>

    <div id="index_post">
	<a href="<?php echo base_url() ?>pages/<?php echo $post_item['slug'] ?>">
	<img id="index_image" src="<?php echo $post_item['image_url']?>"></img>
	<b><?php echo $post_item['subject'] ?></b> got a <b><?php echo $post_item['action']." in the ".$post_item['setting']." ".$post_item['hits']." time(s)."; ?></b>
	</a>
	</div>

<?php endforeach ?>
</div>