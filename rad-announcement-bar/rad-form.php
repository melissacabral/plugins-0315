<div class="wrap">
	<h2>Announcement Bar Settings</h2>
	
	<form method="post" action="options.php">
		<?php 
		//must match register_settings group name
		settings_fields( 'rad_announcement_bar_group' ); 
		//get the current values so we can make the fields "stick"
		$values = get_option('rad_announcement_bar');
		?>
		
		<label>Bar Text:</label>
		<br>
		<input type="text" name="rad_announcement_bar[message]" 
			value="<?php echo $values['message'] ?>" class="regular-text">

		<br><br>

		<label>"Click Here" Link:</label>
		<br>
		<input type="text" name="rad_announcement_bar[link]" 
			value="<?php echo $values['link'] ?>" class="regular-text">

		<br><br>

		<?php submit_button( 'Save Announcement Bar' ); ?>

	</form>
</div>