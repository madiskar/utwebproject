		<div class="browseBar">
			<div class="select">
					<label for="zanr">Zanr: </label>
					<select name="zanr" id="genre">
						<option value="all" selected>Koik</option>
					</select>
					
					<label for="sort">Sorteeri: </label>
					<select name="sort" id="sortby">
						<option value="AZ" selected>A-Z</option>
						<option value="ZA">Z-A</option>
						<option value="bestFirst">Parimad enne</option> 
						<option value="worstFirst">Halvimad enne</option> 
					</select>
				
				<input class="button" type="submit" name="sorteeri" value="Sirvi" onclick="updateSelection()" />			
			</div>
		</div>

	<div id="games">	
		<script>
			//window.onload=function() {
			//	updateSelection();
			//}	

			function clearItems()
			{
				var games = document.getElementById("games");
				while (games.hasChildNodes()) {   
				    games.removeChild(games.firstChild);
				}
			}
		
			function updateSelection() {
				clearItems();
				var sortValue = document.getElementById("sortby");
				var sortBy = sortValue.options[sortValue.selectedIndex].value;
				
		 		var genreValue = document.getElementById("genre");
				var genreType = genreValue.options[genreValue.selectedIndex].value;
				
			  	var xhttp = new XMLHttpRequest();
			  	xhttp.onreadystatechange = function() {
				    if (xhttp.readyState == 4 && xhttp.status == 200) {
					    var gamesArray = JSON.parse(xhttp.responseText);
					    console.log(gamesArray);
					    
					    for(var i = 0; i<gamesArray.length; i++) {
					    	
						    var gameLink = document.createElement("A");
						    gameLink.id = "gamelink";
						    gameLink.href = "http://[::1]/wasdreviews/public_html/index.php/games/" + gamesArray[i][3];
						    gameLink.target = "_blank";
						    
						    var gameContainer = document.createElement("div");
						    gameContainer.id = "container";
						    gameContainer.className = "gameContainer";
						    
						   	var title = document.createElement("div");
						   	title.id = "titleid";
						    title.className = "gameTitle";
					    	title.innerHTML = gamesArray[i][0];
					    	
					    	var gameDesc = document.createElement("div");
					    	gameDesc.id = "gamedesc";
					    	gameDesc.className = "gameDescription";
					    	gameDesc.innerHTML = gamesArray[i][1];

					    	var avgRating = document.createElement("div");
					    	avgRating.id = "avgrating";
					    	avgRating.className = "gameRating";
					    	avgRating.innerHTML = "Hinnang: " + gamesArray[i][2];

					    	var thumbnail = document.createElement("IMG")
					    	thumbnail.className = "gameImage";
					    	thumbnail.alt = gamesArray[i][0]  + " ekraanipilt";
					    	thumbnail.src = "<?php echo $base_url; ?>public/images/TEMP_thumbnail.png";

					    	var lineBreak = document.createElement("BR")

					    	gameContainer.appendChild(thumbnail);
					    	gameContainer.appendChild(title);
					    	gameContainer.appendChild(lineBreak);				    	
					    	gameContainer.appendChild(gameDesc);
					    	gameContainer.appendChild(avgRating);
					    	gameLink.appendChild(gameContainer);
					    	document.getElementById("games").appendChild(gameLink);
						}
				    }
			  	};
			  	xhttp.open("GET", "http://[::1]/wasdreviews/public_html/index.php/browse/update_games?sortby=" + sortBy + "&genre=" + genreType, true);
			  	xhttp.send();
			}
		</script>
	</div>
