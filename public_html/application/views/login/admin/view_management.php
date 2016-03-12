<hr>
			<?php echo validation_errors(); ?>

			<?php echo form_open('management'); ?>
			<div class="searchUsers">
						<label for="usersearch">Otsi kasutajaid</label><br>
						<?php echo form_input('usersearch'); ?>
						<br/>
						<?php echo form_submit('submit', 'OTSI')?>
			</div>
<hr>