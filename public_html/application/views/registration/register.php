				<div class="regOutContainer">
					
					<hr>
					<?php echo validation_errors(); ?>

					<?php echo form_open('register_controller'); ?>
					<div class="regInContainer">
						<label for="username">Kasutajanimi</label><br>
						<?php echo form_input('username'); ?>
						<br/>
						<label for="email">E-Posti aadress</label><br>
						<?php echo form_input('email'); ?>
						<br/>
						<label for="password">Parool</label><br>
						<?php echo form_password('password',''); ?>
						<br/>
						<label for="passConfirm">Korda parooli</label><br>
						<?php echo form_password('passConfirm',''); ?>
						<br/>
						<?php echo form_submit('submit', 'LOO KONTO')?>

						</form>
					</div>
					<hr>
			Ž	</div>