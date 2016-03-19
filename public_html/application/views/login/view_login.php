				<div class="logOuterContainer">
					

					<?php echo form_open('login'); ?>
					<div class="logInnerContainer" align=center>
						<label class="largeLabel" for="username"><?php echo $login_username; ?></label><br>
						<?php echo form_input('username','','class="regForm"'); ?>
						<br/><br>
						<label class="largeLabel" for="password"><?php echo $login_password; ?></label><br>
						<?php echo form_password('password','','class="regForm"'); ?>
						<br><br>
						<div class="formValidationErrorText")>
							<?php echo validation_errors(); ?>
							<?php echo $info; ?>
						</div>
						<br>
						<?php echo form_submit('submit', $login_login ,'class="regButton"')?>
						<br><br>
						<a href="#void" class="orange"><?php echo $login_forgot_pass; ?></a>
						<br><br>
						<hr><br>
						<div class="medText"><?php echo $login_noaccount; ?></div><br>
						<?php echo anchor('register_controller', $login_register, 'class="orange"')?>
						<?php echo form_close(); ?>
						
					</div>
				</div>