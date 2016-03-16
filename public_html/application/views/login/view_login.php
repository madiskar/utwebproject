				<div class="logOuterContainer">
					

					<?php echo form_open('login'); ?>
					<div class="logInnerContainer" align=center>
						<label class="largeLabel" for="username">Kasutajanimi</label><br>
						<?php echo form_input('username','','class="regForm"'); ?>
						<br/><br>
						<label class="largeLabel" for="password">Parool</label><br>
						<?php echo form_password('password','','class="regForm"'); ?>
						<br><br>
						<div class="formValidationErrorText")>
							<?php echo validation_errors(); ?>
							<?php echo $info; ?>
						</div>
						<br>
						<?php echo form_submit('submit', 'MELDI SISSE','class="regButton"')?>
						<br><br>
						<a href="#void" class="orange">Unustasid parooli?</a>
						<br><br>
						<hr><br>
						<div class="medText">Pole kontot?</div><br>
						<?php echo anchor('register_controller', 'REGISTREERU KASUTAJAKS', 'class="orange"')?>
						<?php echo form_close(); ?>
						
					</div>
				</div>