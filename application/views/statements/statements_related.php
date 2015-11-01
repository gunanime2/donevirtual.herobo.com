</br>
<div class="box" id="statements_related">
	<div class="links_title">
		Related Statements
	</div>
	<?php foreach($post as $post_item): ?>
		<?php if($post_item['slug'] != $slug){ ?>
			<div class="links_related">
				<a class="normal_links" href="<?php echo base_url()?>view_statements/<?php echo $post_item['slug'];?>">
				</br>
				<?php echo "To <b>".$post_item['subject']."</b>,  </br><img class='links_image' src=".$post_item['image_url']."> </img> </br>".word_limiter($post_item['statement'], 10).". </br>Views: ".$post_item['views']; ?>
				</a>
			</div>
		<?php }?>
	<?php endforeach?>
</div>