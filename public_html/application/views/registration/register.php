				<div class="regOutContainer">
					
					

					<?php echo form_open('register_controller'); ?>
					<div class="regInContainer" align=center>
						<label class="largeLabel" for="username">Kasutajanimi</label><br>
						<?php echo form_input('username','','class="regForm"'); ?>
						<br/><br/>
						<label class="largeLabel" for="email">E-Posti aadress</label><br>
						<?php echo form_input('email','','class="regForm"'); ?>
						<br/><br/>
						<label class="largeLabel" for="password">Parool</label><br>
						<?php echo form_password('password','','class="regForm"'); ?>
						<br/><br/>
						<label class="largeLabel" for="passConfirm">Korda parooli</label><br>
						<?php echo form_password('passConfirm','','class="regForm"'); ?>
						<br/><br/>
						<div class="formValidationErrorText")>
						<?php echo validation_errors(); ?>
						</div><br/>
						<?php echo form_submit('submit', 'LOO KONTO','class="regButton"')?>

						</form>
						
					</div>
				</div>