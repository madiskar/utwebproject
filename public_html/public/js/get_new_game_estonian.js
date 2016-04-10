var prevMessage = "";
if(typeof(EventSource) !== "undefined") {
    var source = new EventSource("http://wasdreviews.cs.ut.ee/index.php/games/get_new_game_event");
    source.onmessage = function(event) {
		if (prevMessage == ""){
			prevMessage = event.data;
		} else {
			if (prevMessage != event.data){
				var xhttp = new XMLHttpRequest();
			  	xhttp.onreadystatechange = function() {
				    if (xhttp.readyState == 4 && xhttp.status == 200) {
					    var gamesArray = JSON.parse(xhttp.responseText);
					    buildHTML(gamesArray);
				    }
			  	};
			  	xhttp.open("GET", "http://wasdreviews.cs.ut.ee/index.php/games/get_newest_game/" + prevMessage, true);
			  	xhttp.send();
				prevMessage = event.data;
			}
		}
    };
}

function buildHTML(gamesArray) {
	var base_url_origin = window.location.origin;
	
	for(var i = 0; i<gamesArray.length; i++) {
    	
	    var gameLink = document.createElement("A"); //anchor
	    gameLink.id = "gamelink";
	    gameLink.href = "http://wasdreviews.cs.ut.ee/index.php/games/" + gamesArray[i][3];
	    gameLink.target = "_blank";
	    
	    var gameContainer = document.createElement("div"); //maincontainer
	    gameContainer.id = "container";
	    gameContainer.className = "gameContainer";
	    
	   	var title = document.createElement("div"); //title
	   	title.id = "titleid";
	    title.className = "gameTitle";
    	title.innerHTML = gamesArray[i][0];
    	
    	var gameDesc = document.createElement("div"); //description
    	gameDesc.id = "gamedesc";
    	gameDesc.className = "gameDescription";
    	gameDesc.innerHTML = gamesArray[i][1];

    	var avgRating = document.createElement("div"); // average rating
    	avgRating.id = "avgrating";
    	avgRating.className = "gameRating";
    	avgRating.innerHTML = "Hinnang: " + gamesArray[i][2];

    	var thumbnail = document.createElement("IMG"); // thumbnail
    	thumbnail.className = "gameImage";
    	thumbnail.alt = gamesArray[i][0]  + " ekraanipilt";
    	thumbnail.src = "http://wasdreviews.cs.ut.ee/public/images/" + gamesArray[i][3] + "/" + gamesArray[i][4];
    	
    	var lineBreak = document.createElement("BR"); // line break 
    	
    	gameContainer.appendChild(thumbnail);
    	gameContainer.appendChild(title);
    	gameContainer.appendChild(lineBreak);				    	
    	gameContainer.appendChild(gameDesc);
    	gameContainer.appendChild(avgRating);
    	gameLink.appendChild(gameContainer);
    	$(".mainContainer").prepend(gameLink);
	}
}