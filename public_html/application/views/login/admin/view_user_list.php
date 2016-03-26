<div class="managementOuterContainer" align=center>
					
					

	<div class="managementInnerContainer" align=center>
			<?php if ($eksisteerib) {?>
			<table>
				 <tr>
				    <th><?php echo $admin_username; ?></th>
				    <th><?php echo $admin_email; ?></th>
				    <th><?php echo $admin_allowed; ?></th>
				    <th><?php echo $admin_administrator; ?></th>
				  </tr>
				<?php foreach ($user_info as $user): ?>
					<tr>
					<td>
					<div class="medText"><?php echo $user['username']; ?></div>
					</td>
					<td>
				<div class="medText"><?php echo $user['email']; ?></div>
				</td>
				<td>
				<input id="<?php echo $user['id']; ?>" type="checkbox" name="allowed" value="1" <?php echo ($user['allowed'] == 1 ? 'checked' : '') ?> />
				</td>
				<td>
				<input id="<?php echo $user['id']; ?>" type="checkbox" name="admin" value="1" <?php echo ($user['admin'] == 1 ? 'checked' : '') ?> />
				</td>
				</tr>
				<?php endforeach; ?>
			<?php } else { ?>
				<div class="medText"><?php echo $admin_no_user;?></div>
			<?php }?>
			
	</div>
</div>

<script src="<?php echo $base_url; ?>/public/js/checkbox_update.js" type="text/javascript"></script>