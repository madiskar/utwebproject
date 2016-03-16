			
			<?php if ($eksisteerib) {?>
				<h1>Kasutajanimi: <?php echo $username; ?></h1>
				<h1>E-Posti aadress: <?php echo $email; ?></h1>
				<br/>
				<label for="allowed">Luba postitada</label>
				<br/>
				<input type="checkbox" name="allowed" value="1" <?php echo ($allowed == 1 ? 'checked' : '') ?> />
				<br/>
				<label for="admin">Administraator</label>
				<br/>
				<input type="checkbox" name="admin" value="2" <?php echo ($admin == 1 ? 'checked' : '') ?> />
				<br/>
				<input type="submit" name="confirmation" value="Submit"/>
			<?php } else { ?>
				<h1>Sellist kasutajat ei ole!</h1>
			<?php }?>
			
			<?php echo form_close(); ?>