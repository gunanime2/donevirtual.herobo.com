<?php
	echo '<div class="error"><b>'.validation_errors().'</b></div>';
	echo form_open('statements/say');
?>
<div class="links_title"> Say It </div>
<table id="say_form">
	<tr>
		<td>To:</td>
		<td><input class="view_input" type="text" name="subject"/></td>
	</tr><tr>
		<td>Statement:</td>
		<td><textarea class="view_input"  type="text" name="statement"></textarea></td>
	</tr><tr>
		<td>Image Url:</td>
		<td><input class="view_input"  type="text" name="image_url"/></td>
	</tr><tr>
		<td></td>
		<td><img id="captcha" src="http://localhost/donevirtual.com/securimage/securimage_show.php" alt="CAPTCHA Image" /></td>
	</tr><tr>
		<td>Enter Answer:</td>
			<td><input class="view_input"  type="text" name="captcha_code" size="10" maxlength="6" /></td>
			<td><a href="#" onclick="document.getElementById('captcha').src = 'http://localhost/donevirtual.com/securimage/securimage_show.php?' + Math.random(); return false"> Different Image </a></td>
	</tr><tr>
		<td><input class="view_input"  type="submit" name="submit"></td>
	</tr>
</table>

<i>*Clicking submit means that you have read and agreed of our website's <b><a href="<?php echo base_url() ?>about">Terms and Conditions</a></b>.</i>

<p>
</br><b>How to get an Image URL?</b></br>
<p>An image url can be obtained
by right clicking the desired image 
then clicking "copy image url". 
Then right click in the "Image Url" 
box and click "paste"</p>
</p>