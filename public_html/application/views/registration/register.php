				<div class="regOutContainer">
					
					

					<?php echo form_open('register_controller'); ?>
					<div class="regInContainer">
						<label class="largeLabel" for="username"><?php echo $register_username; ?></label><br>
						<?php echo form_input('username', set_value('username', ''),'class="regForm" id="username"'); ?>
						<br/><br/>
						<label class="largeLabel" for="email"><?php echo $register_email; ?></label><br>
						<?php echo form_input('email',set_value('email', ''),'class="regForm" id="email"'); ?>
						<br/><br/>
						<label class="largeLabel" for="password"><?php echo $register_password; ?></label><br>
						<?php echo form_password('password','','class="regForm" id="password"'); ?>
						<br/><br/>
						<label class="largeLabel" for="passConfirm"><?php echo $register_pass_repeat; ?></label><br>
						<?php echo form_password('passConfirm','','class="regForm" id="passConfirm"'); ?>
						<br><br>
						<div class="formValidationErrorText">
							<?php echo validation_errors(); ?>
							<?php echo $info; ?>
						</div>
						<br>
						<?php echo form_submit('submit', $register_createaccount,'class="regButton" onclick="checkConnection(\'registerSubmit\');"')?>

						
						
					</div>
					</form>
				</div>