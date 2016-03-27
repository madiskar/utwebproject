<div class="mainContainer">
			
			<div class="reviewPageContainer">
				<div class="reviewPageTitle">
					<?php echo $admin_addgames?>
				</div>
				<div class="reviewMain">

					<?php echo validation_errors(); ?>

					<?php echo form_open_multipart('games/add')?>

						<label class="largeLabel" for="title"><?php echo $admin_game_name; ?></label><br>
						<input class="regForm" type="text" id="title" name="title" size="50" /><br><br>

						<label for="description"><?php echo $admin_game_description; ?></label><br>
					    <textarea name="description" id="description"></textarea><br><br>

					    <label for="thumbnail"><?php echo $admin_game_tmb; ?></label><br>
					    <input id="thumbnail" type="file" name="thumbnail" size="20" /><br><br>

					    <div id="holder">
						  </div> 
						  <p id="upload" class="hidden"><label><?php $admin_upload_info; ?>:<br><input type="file"></label></p>
						  <p id="filereader"><?php $admin_filereader_info; ?></p>
						  <p id="formdata"><?php $admin_formdata_info; ?></p>
	
					    <label for="mainrev"><?php echo $admin_game_review; ?></label><br>
					    <textarea name="mainrev" id="mainrev"></textarea><br><br>

						<input type="hidden" id="screenshots" name="screenshots"/><br><br>
						

						<input id="genreAction" type="checkbox" name="genres[]" value="1"><label for="genreAction">Action</label><br>
						<input id="genreAdventure" type="checkbox" name="genres[]" value="2"><label for="genreAdventure">Adventure</label><br>
						<input id="genreCasual" type="checkbox" name="genres[]" value="3"><label for="genreCasual">Casual</label><br>
						<input id="genreIndie" type="checkbox" name="genres[]" value="4"><label for="genreIndie">Indie</label><br>
						<input id="genreMMO" type="checkbox" name="genres[]" value="5"><label for="genreMMO">MMO</label><br>
						<input id="genreRacing" type="checkbox" name="genres[]" value="6"><label for="genreRacing">Racing</label><br>
						<input id="genreRPG" type="checkbox" name="genres[]" value="7"><label for="genreRPG">RPG</label><br>
						<input id="genreSimulation" type="checkbox" name="genres[]" value="8"><label for="genreSimulation">Simulation</label><br>
						<input id="genreSports" type="checkbox" name="genres[]" value="9"><label for="genreSports">Sports</label><br>
						<input id="genreStrategy" type="checkbox" name="genres[]" value="10"><label for="genreStrategy">Strategy</label><br><br>

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



					    <input class="button" type="submit" name="submit" value="<?php echo $admin_addgames; ?>" />

					</form>
					<br>
				</div>
			</div>
</div>
<br><br><br>
<script src="<?php echo $base_url; ?>/public/js/dnd_files.js" type="text/javascript"></script>