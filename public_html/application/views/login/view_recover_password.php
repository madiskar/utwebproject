<div class="logOuterContainer">
					

					<?php echo form_open('login/recover_password/'.$user_id.'/'.$rec_key); ?>
					<div class="logInnerContainer">
						<div class="medText"><?php echo $recovery_change_title; ?></div><br>
						<label class="largeLabel" for="password"><?php echo $register_password; ?></label><br>
						<?php echo form_password('password','','class="regForm" id="password"'); ?>
						<br/><br/>
						<label class="largeLabel" for="passConfirm"><?php echo $register_pass_repeat; ?></label><br>
						<?php echo form_password('passConfirm','','class="regForm" id="passConfirm"'); ?>
						<br><br>
						<div class="formValidationErrorText">
							<?php echo validation_errors(); ?>
						</div>
						<br>
						<?php echo form_submit('submit', $recovery_change_button,'class="regButton"')?>
						
					</div>
					<?php echo form_close(); ?>
				</div>