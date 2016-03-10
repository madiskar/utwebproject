<div class="logOuterContainer">
					
					<hr>
					<?php echo validation_errors(); ?>

					<?php echo form_open('login'); ?>
					<div class="logInnerContainer">
						<label for="username">Kasutajanimi</label><br>
						<?php echo form_input('username'); ?>
						<br/>
						<label for="password">Parool</label><br>
						<?php echo form_password('password',''); ?>
						<br>
						<?php echo form_submit('submit', 'MELDI SISSE')?>
						<h3>Unustasid parooli?</h3>
						<h3>Pole kontot?</h3>
						<?php echo anchor('register_controller', 'REGISTREERU KASUTAJAKS')?>
						<?php echo form_close(); ?>
						
					</div>
					<hr>
			Ž	</div>