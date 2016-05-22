			<div class="logOuterContainer">
					

					<?php echo form_open('forgot_password'); ?>
					<div class="logInnerContainer">
						<div class="medText">Unustasid parooli?</div><br>
						<label class="largeLabel" for="email"><?php echo $register_email; ?></label><br>
						<?php echo form_input('email',set_value('email', ''),'class="regForm" id="email"'); ?>
						<br/><br/>
						<div class="formValidationErrorText">
							<?php echo validation_errors(); ?>
						</div>
						<br>
						<?php echo form_submit('submit', "Taasta parool" ,'class="regButton"')?>
					</div>
					<?php echo form_close(); ?>
				</div>