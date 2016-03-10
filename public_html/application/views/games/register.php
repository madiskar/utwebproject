					<hr>
					<?php echo "max skeem"?>
					<?php echo validation_errors(); ?>

					<?php echo form_open('register_controller'); ?>
					
						<h3>Kasutajanimi</h3>
						<input type="text" id="username" name="username" size="50" />

						<h5>E-Posti aadress</h5>
						<input type="text" id="email" name="email" size="50" />
						
						<h5>Parool</h5>
						<input type="text" id="password" name="password" size="50" />

						<h5>Password Confirm</h5>
						<input type="text" id="passConfirm" name="passConfirm" size="50" />

						<div><input class="button" type="submit" name="submit" value="LOO KONTO" /></div>

						</form>
					<hr>