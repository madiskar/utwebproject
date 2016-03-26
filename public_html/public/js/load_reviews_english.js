var startIndex = 0;
var gameId = 0;

$(window).load(function(){
	var scripts = document.getElementsByTagName('script');
    var lastScript = scripts[scripts.length-1];
    var scriptName = lastScript;
    gameId = scriptName.getAttribute('data-gameid');
	loadData();
})

function loadData(){
	var xmlhttp = new XMLHttpRequest();
	var url = "http://[::1]/public_html/index.php/games/loadReviews/" + gameId + "/" + startIndex;

	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var myArr = JSON.parse(xmlhttp.responseText);
			myFunction(myArr);
		}
	};
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
	startIndex += 5;
}

function myFunction(arr) {
	$("#loadMoreButton").remove();
    var i;
    for(i = 0; i < arr.length; i++) {
		$("#reviewPlaceHolder").append('<h2>Review by user ' + arr[i].username + ':</h2><p>' + arr[i].review + '</p><h2> Rating: ' + arr[i].rating + '</h2><hr><br>');
    }
	if (i==5){
	$("#reviewPlaceHolder").append( '<button id="loadMoreButton" class="regButton" onclick="loadData()">LOAD MORE REVIEWS</button>')
	}
}