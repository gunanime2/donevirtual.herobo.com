<div class="box" id="results">
<div class="links_title">
	Results for : "<b><?php echo $this->session->userdata('search');?></b>"
</div>
<?php foreach($post as $post_item): ?>
	<a href="<?php echo base_url()?>view_statements/<?php echo $post_item['slug'];?>">
	<img class="links_image" src="<?php echo $post_item['image_url']?>" alt="<?php echo $post_item['subject']; ?>" title="<?php echo $post_item['subject']; ?>"></img>
	</br>
	<?php echo "To ".$post_item['subject'].", ".word_limiter($post_item['statement'], 10).". </br>Views: ".$post_item['views']; ?>
	Hear It!
	</a>
	</br>
<?php endforeach ?>

	<div>
		<?php echo $links; ?>
	</div>

</div>