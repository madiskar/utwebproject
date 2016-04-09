				<hr>
					
					<?php if($this->session->userdata('username') == FALSE) { ?>
					<h2><?php echo $game_not_logged_in; ?>
					<a class="orange" href="<?php echo  $base_url; ?>index.php/login"><?php echo $game_log_in_to_review; ?> </a></h2>
					<?php } else if($this->session->userdata('allowed') == 0) {?>
					<div class="formValidationErrorText"><br>
					<h2><?php echo $game_not_allowed; ?> :(</h2><br>
					</div>
					<?php } else {?>
					<h2><?php $game_leave_review; ?></h2>
					
					<?php echo validation_errors(); ?>

					<?php echo form_open('games/view/'.$games_item['slug']); ?>

					    <label for="review"><?php echo $game_review; ?></label><br>
					    <textarea name="review" id="review"></textarea><br><br>

					    <label for="rating"><?php echo $game_rating; ?></label><br>
					    <select name="rating" id="rating">
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5" selected>5</option>
						  <option value="6">6</option>
						  <option value="7">7</option>
						  <option value="8">8</option>
						  <option value="9">9</option>
						  <option value="10">10</option>
						</select>

					
					    <input type="hidden" name="game_slug" id="game_slug" value="<?php echo $games_item['slug']; ?>">

					    <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">

					    <input type="hidden" name="game_id" id="game_id" value="<?php echo $games_item['id']; ?>">

					    <input class="button" type="submit" name="reviewSubmit" value="<?php echo $game_add_review ?>" onclick="checkConnection('reviewSubmit');"/>

					</form>
					<?php }?>
					
					<hr><br>
