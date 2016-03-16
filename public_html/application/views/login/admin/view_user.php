<div class="logOuterContainer">
					
					

	<div class="logInnerContainer" align=center>
			<?php if ($eksisteerib) {?>
				<div class="medText">Kasutajanimi: <?php echo $username; ?><br>
				E-Posti aadress: <?php echo $email; ?></div>
				<br/>
				<label class="largeLabel" for="allowed">Luba postitada</label>
				<br/>
				<input type="checkbox" name="allowed" value="1" <?php echo ($allowed == 1 ? 'checked' : '') ?> />
				<br/><br/>
				<label class="largeLabel"  for="admin">Administraator</label>
				<br/>
				<input type="checkbox" name="admin" value="2" <?php echo ($admin == 1 ? 'checked' : '') ?> />
				<br/><br>
				<input class="regButton" type="submit" name="confirmation" value="Submit"/><br>
			<?php } else { ?>
				<div class="medText">Sellist kasutajat ei ole!</div>
			<?php }?>
			
			<?php echo form_close(); ?>
	</div>
</div>