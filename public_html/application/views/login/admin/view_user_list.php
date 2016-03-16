<div class="logOuterContainer">
					
					

	<div class="logInnerContainer" align=center>
			<?php if ($eksisteerib) {?>
				<?php foreach ($user_info as $user): ?>
					<div class="medText">
						<?php echo $user['username'] ?>
					</div>
				<?php endforeach; ?>
			<?php } else { ?>
				<div class="medText">Sellist kasutajat ei ole!</div>
			<?php }?>
			
	</div>
</div>