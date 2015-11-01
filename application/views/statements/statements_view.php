<div class="box"  id="results">
	
	<div class="links_title">
		<?php echo $post_item['subject'];?>
	</div>

	<img id='view_image' src="<?php echo $post_item['image_url']; ?>" alt="<?php echo $post_item['subject']; ?>" title="<?php echo $post_item['subject']; ?>"></img></br>
	To <?php echo $post_item['subject']; ?>, </br><?php echo $post_item['statement']; ?> </br>Views: <?php echo $post_item['views']; ?>

	<?php
		/*percentage formula
			a / total	= c
			b * 100		= the answer!!!
		*/
		$positive 	= $post_item['positive'];
		$negative 	= $post_item['negative'];
		$total		= $positive + $negative;
		
		if($total == 0){
			$positive 	= 1;
			$negative 	= 1;
			$total 		= 2;
		}
		$positive = ($positive / $total) * 100;
		$negative = ($negative / $total) * 100;
	?>
	<p>
	<div  style="position:relative;width:100%;background-color:#000000;color:white;margin:auto;">
		<label class="yes_no"  style="font-size:120%;width:<?php echo $positive;?>%;background-color:green;float:left;">Yes(<?php echo number_format($positive, 5);?>%)</label>
		<label class="yes_no"  style="font-size:120%;width:<?php echo $negative;?>%;background-color:red;float:left;">No(<?php echo number_format($negative, 5);?>%)</label>
	</div>	
	</p>
	
	</br>
	
	<p>
		<?php echo "Pro: <b>".$post_item['positive']."</b>	VS	Anti: <b>".$post_item['negative']."</b>";?>
	</p>
	<p>
		<?php  echo form_open('statements/vote');?>
		<div id="vote_hidden">
			<input type="text" name="say_id" value="<?php echo $post_item['say_id']?>"/>
		</div>
	<div>
		<img id="captcha" src="http://localhost/donevirtual.com/securimage/securimage_show.php" alt="CAPTCHA Image" />
		</br>
		Enter Answer:<input  class="view_input"  type="text" name="captcha_code" size="10" maxlength="6" />
		</br>
		<a href="#" onclick="document.getElementById('captcha').src = 'http://localhost/donevirtual.com/securimage/securimage_show.php?' + Math.random(); return false"> Different Image </a>
	</div>
			<input class="view_input" type="submit" name="yes" value="Yes!"/> OR <input  class="view_input"  type="submit" name="no" value="No!">
		</form>
		<i>* Input Answer before voting.</i>
	</p>
</div>