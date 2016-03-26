//English

window.onload = checkHash();

window.addEventListener('hashchange', function() {
	checkHash();
});

function clearItems() {
	var games = document.getElementById("games");
	while (games.hasChildNodes()) {   
		games.removeChild(games.firstChild);
	}
}

function buildHTML(gamesArray) {
	var base_url_origin = window.location.origin;
	
	for(var i = 0; i<gamesArray.length; i++) {
    	
		var gameLink = document.createElement("A"); //anchor
		gameLink.id = "gamelink";
		gameLink.href = base_url_origin + "/wasdreviews/public_html/index.php/games/" + gamesArray[i].slug;
		//gameLink.href = "http://wasdreviews.cs.ut.ee/index.php/games/" + gamesArray[i].slug;
		    
		var gameContainer = document.createElement("div"); //maincontainer
		gameContainer.id = "container";
		gameContainer.className = "gameContainer";
		    
		var title = document.createElement("div"); //title
		title.id = "titleid";
		title.className = "gameTitle";
	    	title.innerHTML = gamesArray[i].title;
	    	
	    	var gameDesc = document.createElement("div"); //description
	    	gameDesc.id = "gamedesc";
	    	gameDesc.className = "gameDescription";
	    	gameDesc.innerHTML = gamesArray[i].description;
	
	    	var avgRating = document.createElement("div"); // average rating
	    	avgRating.id = "avgrating";
	    	avgRating.className = "gameRating";
	    	avgRating.innerHTML = "Rating: " + gamesArray[i].average_rating;
	
	    	var thumbnail = document.createElement("IMG"); // thumbnail
	    	thumbnail.className = "gameImage";
	    	thumbnail.alt = gamesArray[i].title  + " screenshot";
	    	thumbnail.src = base_url_origin + "/wasdreviews/public_html/public/images/TEMP_thumbnail.png";
	    	//thumbnail.src = "http://wasdreviews.cs.ut.ee/public/images/" + gamesArray[i].slug + "/" + gamesArray[i].thmb_extension;
	    	var lineBreak = document.createElement("BR"); // line break
	    	
	    	gameContainer.appendChild(thumbnail);
	    	gameContainer.appendChild(title);
	    	gameContainer.appendChild(lineBreak);
	    	gameContainer.appendChild(gameDesc);
	    	gameContainer.appendChild(avgRating);
	    	gameLink.appendChild(gameContainer);
	    	document.getElementById("games").appendChild(gameLink);
	}
}

function getParameterByName(name, string) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(string);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

function handleClick() {
	var sortValue = document.getElementById("sortby");
	var sortBy = sortValue.options[sortValue.selectedIndex].value
	
	var genreValue = document.getElementById("genre");
	var genreType = genreValue.options[genreValue.selectedIndex].value;

	var currentSelection = [sortBy, genreType];
	displaySelection(sortBy, genreType);
	history.pushState(currentSelection, null, "#?sortby=" + sortBy + "&genre=" + genreType);
}

function setSelectedItems(sortby, genre) {
	//set the correct selected items in dropdown menus
	//based on current selection of games
	var dm1 = document.getElementById('genre');
	for (var i = 0; i < dm1.options.length; i++) {
	    	if (dm1.options[i].value == genre) {
	        	dm1.selectedIndex = i;
	        	break;
    		}
	}
	var dm2 = document.getElementById('sortby');
	for (var j = 0; j < dm2.options.length; j++) {
	    	if (dm2.options[j].value == sortby) {
	        	dm2.selectedIndex = j;
	        	break;
	    	}
	}
}

function checkHash() {
	if(window.location.hash) {
		var urlhash = window.location.hash.substring(1);
		var loadsort = getParameterByName("sortby", urlhash);
		var loadgenre = getParameterByName("genre", urlhash);
		setSelectedItems(loadsort, loadgenre);
		displaySelection(loadsort, loadgenre);
	} else {
		clearItems();
	}
}

function displaySelection(sortBy, genreType) {
	clearItems();
	var base_url = window.location.origin + window.location.pathname;
	
  	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
		    var gamesArray = JSON.parse(xhttp.responseText);
		    buildHTML(gamesArray);
	    }
  	};
  	xhttp.open("GET", base_url + "/update_games?sortby=" + sortBy + "&genre=" + genreType, true);
  	xhttp.send();
}
