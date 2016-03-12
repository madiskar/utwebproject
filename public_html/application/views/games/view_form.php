					<hr>
					
					<?php if($this->session->userdata('username') == FALSE) { ?>
					<h2>Oma arvustuse jätmiseks 
					<a href="<?php echo  $base_url; ?>index.php/login">meldi sisse</a></h2>
					<?php } else {?>
					<h2>Jäta oma arvustus</h2>
					
					<?php echo validation_errors(); ?>

					<?php echo form_open('games/view/'.$games_item['slug']); ?>

					    <label for="review">Arvustus</label><br>
					    <textarea name="review" id="review"></textarea><br><br>

					    <label for="rating">Hinnang</label><br>
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


					    <input type="hidden" name="user_id" value="1">

					    <input type="hidden" name="game_id" value="<?php echo $games_item['id']; ?>">

					    <input class="button" type="submit" name="submit" value="Lisa arvustus" />

					</form>
					<?php }?>
					
					<hr>