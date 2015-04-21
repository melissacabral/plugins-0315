<div class="wrap">
	<h2>Company Information</h2>
	<p>This info will be displayed publicly on your contact page and throughout the site</p>

	<form method="post" action="options.php">
		<?php 
		//must match register_settings group name
		settings_fields( 'rad_options_group' ); 
		//get the current values so we can make the fields "stick"
		$values = get_option('rad_options');
		?>
		
		<label>Company Phone Number:</label>
		<br>
		<input type="tel" name="rad_options[phone]" 
			value="<?php echo $values['phone'] ?>" class="regular-text">

		<br><br>

		<label>Customer Service Email:</label>
		<br>
		<input type="email" name="rad_options[email]" 
			value="<?php echo $values['email'] ?>" class="regular-text">

		<br><br>

		<label>Mailing Address:</label>
		<br>
		<textarea name="rad_options[address]" class="large-text code"><?php 
			echo $values['address'] ?></textarea>

		<?php submit_button( 'Save Company Info' ); ?>

	</form>
</div>