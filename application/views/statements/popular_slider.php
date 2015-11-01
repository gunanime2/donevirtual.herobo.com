<div id="board">
	<div id="board_content">
		<?php foreach($post as $post_item): ?>
		<div class="slide_content">
			<a href="<?php echo base_url()?>view_statements/<?php echo $post_item['slug'];?>">
				<img  id="board_image" src="<?php echo $post_item['image_url'];?>"/>
					<div class="slide_text">
					<b><?php echo $post_item['subject'];?></b>
						</br>
						<?php echo word_limiter($post_item['statement'], 10);?>
					</div>
					<div class="slide_yes_no">
						<span><b>YES</b></span>
						or
						<span><b>NO</b></span>
					</div>
			</a>
		</div>
		<?php endforeach?>
	</div>
	
	<div id="board_content">
		<?php foreach($recent as $post_item): ?>
		<div class="slide_content_recent">
			<a href="<?php echo base_url()?>view_statements/<?php echo $post_item['slug'];?>">
				<img  id="board_image" src="<?php echo $post_item['image_url'];?>"/>
					<div class="slide_text">
					<b><?php echo $post_item['subject'];?></b>
						</br>
						<?php echo word_limiter($post_item['statement'], 10);?>
					</div>
					<div class="slide_yes_no">
						<span><b>YES</b></span>
						or
						<span><b>NO</b></span>
					</div>
			</a>
		</div>
		<?php endforeach?>
	</div>
</div>