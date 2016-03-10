				<div class="regOutContainer">
					
					<hr>
					<?php echo validation_errors(); ?>

					<?php echo form_open('register_controller'); ?>
					<div class="regInContainer">
						<h3>Kasutajanimi</h3>
						<input type="text" id="username" name="username" size="50" />

						<h3>E-Posti aadress</h3>
						<input type="text" id="email" name="email" size="50" />
						
						<h3>Parool</h3>
						<input type="text" id="password" name="password" size="50" />

						<h3>Password Confirm</h3>
						<input type="text" id="passConfirm" name="passConfirm" size="50" />

						<div><input class="button" type="submit" name="submit" value="LOO KONTO" /></div>

						</form>
					</div>
					<hr>
			Ž	</div>