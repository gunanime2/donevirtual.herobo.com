<div id="view_box">

<div id="view_title">
	<h2><?php echo $post_item['subject']?></h2>
</div>

<div id="view_content">
	<img id="view_image" src="<?php echo $post_item['image_url']?>"></img>
	</br>
	<b>
	<?php echo $post_item['subject']?> got a <?php echo $post_item['action']." in the ".$post_item['setting']?> <?php echo $post_item['hits']?> time(s).

		</br>Join the fun, <?php echo $post_item['action']." ".$post_item['subject']." in the ".$post_item['setting']." too."?></br>
	</b>	
	<?php
		echo form_open('pages/plus');
	?>	
			<div id="hidden">
			<input type="text" name="plus_one" value="1"/>
			<input type="text" name="post_id" value="<?php echo $post_item['post_id']?>"/>
			<input type="text" name="slug" value="<?php echo $post_item['slug']?>"/>
			</div>

	<img id="captcha" src="http://localhost/donevirtual.com/securimage/securimage_show.php" alt="CAPTCHA Image" /></br>
	Enter Answer:
	<input class="plus_one" type="text" name="captcha_code" size="10" maxlength="6" />
	<a href="#" onclick="document.getElementById('captcha').src = 'http://localhost/donevirtual.com/securimage/securimage_show.php?' + Math.random(); return false"> Different Image </a>

		</br>
		<input class="plus_one" type="submit" name="plus" value="<?php echo $post_item['action']." ".$post_item['subject']." in the ".$post_item['setting']?> +1"/>
		</form>
</div> <!--end view_content-->
		
</div> <!--end div view_box-->
</br>
<div id="post_too">
	Want to make a post like this?</br>
	Do you want to do something to someone?</br>
	Do it virtually! Click <b><a href="<?php base_url()?>post">HERE.</a></b></br>
</div>

	
