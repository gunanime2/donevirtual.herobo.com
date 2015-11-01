<div class='side_bar'>
<div id="results_for" >
	Results for: "<b><?php echo $this->session->userdata('search');?></b>"
</div>
<?php foreach ($post as $post_item): ?>
</br>
	<?php
		echo $post_item['slug'];
	?>

<?php endforeach ?>
</div>
<div id="links">
	<?php echo $links; ?>
</div>