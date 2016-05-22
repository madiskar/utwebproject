<div class="mainContainer">
			
			<div class="reviewPageContainer">
				<div class="reviewPageTitle">
					<?php echo $admin_addgames?>
				</div>
				<div class="reviewMain">

					<?php echo $custom_error; ?>
					<?php echo validation_errors(); ?>

					<?php echo form_open_multipart('games/add')?>

						<label class="largeLabel" for="title"><?php echo $admin_game_name; ?></label><br>
						<input class="regForm" type="text" id="title" name="title" size="50" /><br><br>

						<label for="description"><?php echo $admin_game_description; ?></label><br>
					    <textarea name="description" id="description"></textarea><br><br>

					    <label for="thumbnail"><?php echo $admin_game_tmb; ?></label><br>
					    <input id="thumbnail" type="file" name="thumbnail" size="20" /><br><br>

					     <?php echo $game_screenshot_text; ?>
					    <div id="holder">
						  </div> 
						  <p id="upload" class="hidden"><label><?php $admin_upload_info; ?>:<br><input type="file" id="file"></label></p>
						  <p id="filereader"><?php $admin_filereader_info; ?></p>
						  <p id="formdata"><?php $admin_formdata_info; ?></p>
	
					    <label for="mainrev"><?php echo $admin_game_review; ?></label><br>
					    <textarea name="mainrev" id="mainrev"></textarea><br><br>

						<input type="hidden" id="screenshots" name="screenshots"/><br><br>
						
						
						<input id="genreAction" type="checkbox" name="genres[]" value="1"><label for="genreAction"><?php echo $action; ?></label><br>
						<input id="genreAdventure" type="checkbox" name="genres[]" value="2"><label for="genreAdventure"><?php echo $adventure; ?></label><br>
						<input id="genreCasual" type="checkbox" name="genres[]" value="3"><label for="genreCasual"><?php echo $casual; ?></label><br>
						<input id="genreIndie" type="checkbox" name="genres[]" value="4"><label for="genreIndie"><?php echo $indie; ?></label><br>
						<input id="genreMMO" type="checkbox" name="genres[]" value="5"><label for="genreMMO"><?php echo $mmo; ?></label><br>
						<input id="genreRacing" type="checkbox" name="genres[]" value="6"><label for="genreRacing"><?php echo $racing; ?></label><br>
						<input id="genreRPG" type="checkbox" name="genres[]" value="7"><label for="genreRPG"><?php echo $rpg; ?></label><br>
						<input id="genreSimulation" type="checkbox" name="genres[]" value="8"><label for="genreSimulation"><?php echo $simulation; ?></label><br>
						<input id="genreSports" type="checkbox" name="genres[]" value="9"><label for="genreSports"><?php echo $sports; ?></label><br>
						<input id="genreStrategy" type="checkbox" name="genres[]" value="10"><label for="genreStrategy"><?php echo $strategy; ?></label><br><br>

					    <label for="mainrating"><?php echo $admin_game_rating; ?></label><br>
					    <select name="mainrating" id="mainrating">
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



					    <input class="button" type="submit" name="submit" value="<?php echo $admin_addgames; ?>" onclick="checkConnection('addSubmit');" />

					</form>
					<br>
				</div>
			</div>
</div>
<br><br><br>
<script defer src="<?php echo $base_url; ?>/public/js/dnd_files.js" type="text/javascript"></script>