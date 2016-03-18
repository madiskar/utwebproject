		<div class="browseBar">
			<div class="select">
					<label for="zanr">Zanr: </label>
					<select name="zanr" id="genre">
						<option value="all" selected >Koik</option>
						<option value="action">Action</option>
						<option value="adventure">Adventure</option>
						<option value="casual">Casual</option>
						<option value="indie">Indie</option>
						<option value="mmo">Massively Multiplayer</option>
						<option value="racing">Racing</option>
						<option value="rpg">RPG</option>
						<option value="simulation">Simulation</option>
						<option value="sports">Sports</option>
						<option value="strategy">Strategy</option>
					</select>
					
					<label for="sort">Sorteeri: </label>
					<select name="sort" id="sortby">
						<option value="AZ" selected>A-Z</option>
						<option value="ZA">Z-A</option>
						<option value="bestFirst">Parimad enne</option>
						<option value="worstFirst">Halvimad enne</option>
					</select>
				
				<input class="button" type="submit" name="sorteeri" value="Sirvi" onclick="displaySelection()" />			
			</div>
		</div>

	<div id="games">
		<script src="<?php echo $base_url; ?>public/js/browsing.js"></script>
	</div>