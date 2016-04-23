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
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $user['id']; ?>">
				<input id="<?php echo $user['id']; ?>" type="checkbox" class="allowed" name="allowed" value="1" <?php echo ($user['allowed'] == 1 ? 'checked' : '') ?> onclick="checkConnection('changeAllowed');" />
				</td>
				<td>
				<input id="<?php echo $user['id']; ?>" type="checkbox" class="admin" name="admin" value="1" <?php echo ($user['admin'] == 1 ? 'checked' : '') ?> onclick="checkConnection('changeAdmin');"/>
				</td>
				</tr>
				<?php endforeach; ?>
				</table>
			<?php } else { ?>
				<div class="medText"><?php echo $admin_no_user;?></div>
			<?php }?>
			
	</div>
</div>

<script defer src="<?php echo $base_url; ?>/public/js/checkbox_update.js" type="text/javascript"></script>