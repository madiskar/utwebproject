var base_url = "http://[::1]/public_html/"

function changeLargeImage(img_url){
	$('#reviewPageGameImage').attr("src",img_url);
}

function showDelete(){
	$("#deleteForReal").slideToggle(500);
}