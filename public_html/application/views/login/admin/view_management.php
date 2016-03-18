<div class="logOuterContainer">
					
					
	<div class="logInnerContainer" align=center>
			<?php echo validation_errors(); ?>

			<?php echo form_open('management'); ?>
			<div class="searchUsers">
						<label class="largeLabel" for="usersearch"><?php echo $admin_searchusers; ?></label><br>
						<?php echo form_input('usersearch','','class="regForm"'); ?>
						<br/><br/>
						<?php echo form_submit('submit', $admin_search,'class="regButton"')?>
			</div>
	</div>
</div>