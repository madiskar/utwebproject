					<hr>
					
					<?php if($this->session->userdata('username') == FALSE) { ?>
					<h2><?php echo $game_not_logged_in; ?>
					<a class="orange" href="<?php echo  $base_url; ?>index.php/login"><?php echo $game_log_in_to_review; ?> </a></h2>
					<?php } else if($this->session->userdata('allowed') == 0) {?>
					<div class="formValidationErrorText"><br>
					<h2><?php echo $game_not_allowed; ?> :(</h2><br>
					</div>
					<?php } else {?>
					<?php if($userHasLeftReview) {?>
					<h2><?php echo $game_change_review; ?></h2>
					<?php } else {?>
					<h2><?php echo $game_leave_review; ?></h2>
					<?php } ?>
					
					<?php echo validation_errors(); ?>

					<?php echo form_open('games/view/'.$games_item['slug']); ?>

					    <label for="review"><?php echo $game_review; ?></label><br>
					    <textarea name="review" id="review"><?php echo str_replace('<br />', '', $prev_review['review']); ?></textarea><br><br>

					    <label for="rating"><?php echo $game_rating; ?></label><br>
					    <select name="rating" id="rating">
						  <option value="1" <?php echo $prev_review['rating']=='1' ? 'selected' : ''; ?>>1</option>
						  <option value="2" <?php echo $prev_review['rating']=='2' ? 'selected' : ''; ?>>2</option>
						  <option value="3" <?php echo $prev_review['rating']=='3' ? 'selected' : ''; ?>>3</option>
						  <option value="4" <?php echo $prev_review['rating']=='4' ? 'selected' : ''; ?>>4</option>
						  <option value="5" <?php echo $prev_review['rating']=='5' ? 'selected' : ''; ?>>5</option>
						  <option value="6" <?php echo $prev_review['rating']=='6' ? 'selected' : ''; ?>>6</option>
						  <option value="7" <?php echo $prev_review['rating']=='7' ? 'selected' : ''; ?>>7</option>
						  <option value="8" <?php echo $prev_review['rating']=='8' ? 'selected' : ''; ?>>8</option>
						  <option value="9" <?php echo $prev_review['rating']=='9' ? 'selected' : ''; ?>>9</option>
						  <option value="10" <?php echo $prev_review['rating']=='10' ? 'selected' : ''; ?>>10</option>
						</select>

					
					    <input type="hidden" name="game_slug" id="game_slug" value="<?php echo $games_item['slug']; ?>">

					    <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">

					    <input type="hidden" name="game_id" id="game_id" value="<?php echo $games_item['id']; ?>">
					    
					    <input type="hidden" name="is_update" id="is_update" value="<?php echo $userHasLeftReview==TRUE ? '1' : '0'; ?>">
					    
					    <input type="hidden" name="is_remove" id="is_remove" value="0">

					    <input class="button" type="submit" name="reviewSubmit" value="<?php echo $userHasLeftReview==TRUE ? $game_update_review : $game_add_review ?>" onclick="checkConnection('reviewSubmit');"/>
					    <?php if($userHasLeftReview) {?>
					<a id="deleteReviewButton" href="#void" onclick="showReviewDelete();">
						<?php echo $game_delete_review; ?>
					</a><br><br>
					<input class="button_red" type="submit" id="reviewDelete" name="reviewDelete" value="<?php echo $game_delete_review_confirm; ?>" onclick="setDelete();"/>
					<?php }?>

					</form>
					
					<?php }?>
					
					<hr><br>