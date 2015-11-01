<div class="deed_form">

	<h3>Post a Deed</h3>
	
<?php
	echo '<div class="error"><b>'.validation_errors().'</b></div>';
	echo form_open('pages/post');
?>	
<b>
	<table class="deed_form">
		<tr><td>Name/Subject:</td>
			<td><input type="input" name="subject"></td>
		</tr>
		<tr><td>Action: </td>
			<td><input type="input" name="action"></td>
		</tr>
		<tr>
			<td>in the</td>
			<td><input type="input" name="setting"></td>
		</tr>
		<tr><td>Image Url:</td>
			<td><input type="input" name="image_url"/></td>
		</tr>
		<tr><td></td>
			<td><img id="captcha" src="http://localhost/donevirtual.com/securimage/securimage_show.php" alt="CAPTCHA Image" /></td>
		</tr>
		<tr><td>Enter Answer:</td>
			<td><input type="text" name="captcha_code" size="10" maxlength="6" /></td>
			<td><a href="#" onclick="document.getElementById('captcha').src = 'http://localhost/donevirtual.com/securimage/securimage_show.php?' + Math.random(); return false"> Different Image </a></td>
		</tr>	
		<tr><td></td><td><input type="submit" name="submit" value="submit"/></td>
		</tr>
	</table>
</b>
</form>

<i>*Clicking submit means that you have read and agreed of our website's <b><a href="<?php echo base_url() ?>about">Terms and Conditions</a></b>.</i>

<p>
</br><b>How to get an Image URL?</b></br>
<p>An image url can be obtained
by right clicking the desired image 
then clicking "copy image url". 
Then right click in the "Image Url" 
box and click "paste"</p>
</p>

</div>