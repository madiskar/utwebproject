<div id="userInfo" class="logOuterContainer">
					
					

	<div class="logInnerContainer" align=center>
			<?php if ($eksisteerib) {?>
				<div class="medText"><?php echo $admin_username; ?>: <?php echo $username; ?><br>
				<?php echo $admin_email; ?>: <?php echo $email; ?></div>
				<br/>
				<label class="largeLabel" for="allowed"><?php echo $admin_allowed; ?></label>
				<br/>
				<input type="checkbox" name="allowed" value="1" <?php echo ($allowed == 1 ? 'checked' : '') ?> />
				<br/><br/>
				<label class="largeLabel"  for="admin"><?php echo $admin_administrator; ?></label>
				<br/>
				<input type="checkbox" name="admin" value="2" <?php echo ($admin == 1 ? 'checked' : '') ?> />
				<br/><br>
				<input class="regButton" type="submit" name="confirmation" value="<?php echo $admin_submituserdata; ?>"/><br>
			<?php } else { ?>
				<div class="medText"><?php echo $admin_no_user; ?></div>
			<?php }?>
			
			<?php echo form_close(); ?>
	</div>
</div>