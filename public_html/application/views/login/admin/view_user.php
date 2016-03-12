			<?php if ($eksisteerib) {?>
				<h1>Kasutajanimi: <?php echo $username; ?></h1>
				<h1>E-Posti aadress: <?php echo $email; ?></h1>
				<br/>
				<label for="allowed">Luba postitada</label>
				<br/>
				<?php echo form_checkbox('allowed', 'allowed', $allowed == 1); ?>
				<br/>
				<label for="admin">Administraator</label>
				<br/>
				<?php echo form_checkbox('admin', 'admin', $admin == 1); 
			} else { ?>
				<h1>Sellist kasutajat ei ole!</h1>
			<?php }?>
			