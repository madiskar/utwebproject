		<?php $jsfilepath = "".$base_url."public/js/browsing_".$this->session->userdata('language').".js"; 
			if($jsfilepath == "".$base_url."public/js/browsing_.js") {
				$jsfilepath = "".$base_url."public/js/browsing_english.js";
			}
		?>
		<div class="browseBar">
			<div class="select">
					<label class="largeLabelSearch" for="genre"><?php echo $genre; ?> </label>
					<select name="zanr" id="genre">
						<option value="all" selected ><?php echo $all; ?></option>
						<option value="action"><?php echo $action; ?></option>
						<option value="adventure"><?php echo $adventure; ?></option>
						<option value="casual"><?php echo $casual; ?></option>
						<option value="indie"><?php echo $indie; ?></option>
						<option value="mmo"><?php echo $mmo; ?></option>
						<option value="racing"><?php echo $racing; ?></option>
						<option value="rpg"><?php echo $rpg; ?></option>
						<option value="simulation"><?php echo $simulation; ?></option>
						<option value="sports"><?php echo $sports; ?></option>
						<option value="strategy"><?php echo $strategy; ?></option>
					</select>
					
					<label class="largeLabelSearch" for="sortby"><?php echo $sort; ?> </label>
					<select name="sort" id="sortby">
						<option value="AZ" selected>A-Z</option>
						<option value="ZA">Z-A</option>
						<option value="bestFirst"><?php echo $parimad; ?></option>
						<option value="worstFirst"><?php echo $halvimad; ?></option>
					</select>
				
				<input class="searchButton" type="submit" name="sorteeri" value="<?php echo $sirvi; ?>" onclick="handleClick()" />			
			</div>
		</div>
	<div id="games" class="mainContainer"></div>
	<script defer src="<?php echo $jsfilepath; ?>"></script>