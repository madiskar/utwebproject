function checkConnection(buttonName) {
  var xhr = new ( window.ActiveXObject || XMLHttpRequest )( "Microsoft.XMLHTTP" );
  var status;

  // Open new request as a HEAD to the root hostname with a random param to bust the cache
  xhr.open( "HEAD", "//" + window.location.hostname + "/?rand=" + Math.floor((1 + Math.random()) * 0x10000), false );

  // Issue request and handle response
  try {
    xhr.send();
    
    if ( xhr.status >= 200 && xhr.status < 300 || xhr.status === 304 ) {
    	if (window.localStorage) {
    		if (localStorage.getItem('connection') == null || localStorage.getItem('connection') == 'online') {
			localStorage.setItem('connection', 'online');
		}
		else {
			setData();
		}
	}
    }
  } catch (error) {
  	alert("You have no internet connection, you may resume but the changes you make will take effect after connection has been reestablished."); 
  	localStorage.setItem('connection', 'offline');
  	saveData(buttonName);
  }
}
function saveData(buttonName) {
	//alert("ops");
	localStorage.setItem('form', buttonName);
	if (buttonName == 'reviewSubmit') {
		localStorage.setItem('review', $("#review").val());
		localStorage.setItem('rating', $("#rating").val());
		localStorage.setItem('user_id', $("#user_id").val());
		localStorage.setItem('game_id', $("#game_id").val());
		localStorage.setItem('game_slug', $("#game_slug").val());
	}
	if (buttonName == 'registerSubmit') {
		localStorage.setItem('username', $("#username").val());
		localStorage.setItem('email', $("#email").val());
		localStorage.setItem('password', $("#password").val());
		localStorage.setItem('passConfirm', $("#passConfirm").val());
	}
	if (buttonName == 'addSubmit') {
		localStorage.setItem('title', $("#title").val());
		localStorage.setItem('description', $("#description").val());
		localStorage.setItem('thumbnail', $("#thumbnail").val());
		//localStorage.setItem('file', $("#file").val());
		localStorage.setItem('mainrev', $("#mainrev").val());
		localStorage.setItem('screenshots', $("#screenshots").val());
		localStorage.setItem('genreAction', $("#genreAction").val());
		localStorage.setItem('genreAdventure', $("#genreAdventure").val());
		localStorage.setItem('genreCasual', $("#genreCasual").val());
		localStorage.setItem('genreIndie', $("#genreIndie").val());
		localStorage.setItem('genreMMO', $("#genreMMO").val());
		localStorage.setItem('genreRacing', $("#genreRacing").val());
		localStorage.setItem('genreRPG', $("#genreRPG").val());
		localStorage.setItem('genreSimulation', $("#genreSimulation").val());
		localStorage.setItem('genreSports', $("#genreSports").val());
		localStorage.setItem('genreStrategy', $("#genreStrategy").val());
		localStorage.setItem('mainrating', $("#mainrating").val());
	}
	//if (buttonName == 'changeAdmin' || buttonName == 'changeAllowed') {
	//	localStorage.setItem('user', $("#user_id").val());
	//	//alert("skeem");
	//	if ($('.allowed').is(":checked")) {
	//		alert("lappes");
		
	
	//		localStorage.setItem(allowed, 1);
	//	}
	//	else {
	//		localStorage.setItem(allowed, 0);
	//	}
	//	if ($("input.admin:checkbox").is(":checked") {
	//		localStorage.setItem(admin, 1);
	//	}
	//	else {
	//		localStorage.setItem(admin, 0);
	//	}
	//}
}

function setData() {
	localStorage.setItem('connection', 'online');
	if (localStorage.getItem('form') == 'reviewSubmit') {
    			var formData =  new FormData();
      			formData.append('review', localStorage.getItem('review'));
      			formData.append('rating', localStorage.getItem('rating'));
      			formData.append('user_id', localStorage.getItem('user_id'));
		      	formData.append('game_id', localStorage.getItem('game_id'));
		      	var xhr = new XMLHttpRequest();
		       	xhr.open('POST', 'http://wasdreviews.cs.ut.ee/index.php/games/' + localStorage.getItem('game_slug'), true);
		       	xhr.send(formData);
        		xhr.onreadystatechange = function() {
    			if (xhr.readyState == XMLHttpRequest.DONE) {
        
        		}
    			}
    			localStorage.removeItem('form');
    			localStorage.removeItem('review');
    			localStorage.removeItem('rating');
    			localStorage.removeItem('user_id');
    			localStorage.removeItem('game_id');
    			localStorage.removeItem('game_slug');
    	}
    	if (localStorage.getItem('form') == 'registerSubmit') {
    			var formData =  new FormData();
      			formData.append('username', localStorage.getItem('username'));
      			formData.append('email', localStorage.getItem('email'));
      			formData.append('password', localStorage.getItem('password'));
		      	formData.append('passConfirm', localStorage.getItem('passConfirm'));
		      	var xhr = new XMLHttpRequest();
		       	xhr.open('POST', 'http://wasdreviews.cs.ut.ee/index.php/register_controller', true);
		       	xhr.send(formData);
        		xhr.onreadystatechange = function() {
    			if (xhr.readyState == XMLHttpRequest.DONE) {
        
        		}
    			}
    			localStorage.removeItem('form');
    			localStorage.removeItem('username');
    			localStorage.removeItem('email');
    			localStorage.removeItem('password');
    			localStorage.removeItem('passConfirm');
    	}
    	if (localStorage.getItem('form') == 'addSubmit') {
    			var formData =  new FormData();
      			formData.append('title', localStorage.getItem('title'));
      			formData.append('description', localStorage.getItem('description'));
      			formData.append('thumbnail', localStorage.getItem('thumbnail'));
		      	//formData.append('file', localStorage.getItem('file'));
		      	formData.append('mainrev', localStorage.getItem('mainrev'));
      			formData.append('screenshots', localStorage.getItem('screenshots'));
      			formData.append('genreAction', localStorage.getItem('genreAction'));
		      	formData.append('genreAdventure', localStorage.getItem('genreAdventure'));
		      	formData.append('genreCasual', localStorage.getItem('genreCasual'));
      			formData.append('genreIndie', localStorage.getItem('genreIndie'));
      			formData.append('genreMMO', localStorage.getItem('genreMMO'));
		      	formData.append('genreRPG', localStorage.getItem('genreRPG'));
		      	formData.append('genreSimulation', localStorage.getItem('genreSimulation'));
      			formData.append('genreSports', localStorage.getItem('genreSports'));
		      	formData.append('genreStrategy', localStorage.getItem('genreStrategy'));
		      	formData.append('username', localStorage.getItem('mainrating'));
		      	var xhr = new XMLHttpRequest();
		       	xhr.open('POST', 'http://wasdreviews.cs.ut.ee/index.php/games/add', true);
		       	xhr.send(formData);
        		xhr.onreadystatechange = function() {
    			if (xhr.readyState == XMLHttpRequest.DONE) {
        
        		}
    			}
    			localStorage.removeItem('form');
    			localStorage.removeItem('title');
			localStorage.removeItem('description');
			localStorage.removeItem('thumbnail');
			//localStorage.removeItem('file');
			localStorage.removeItem('mainrev');
			localStorage.removeItem('screenshots');
			localStorage.removeItem('genreAction');
			localStorage.removeItem('genreAdventure');
			localStorage.removeItem('genreCasual');
			localStorage.removeItem('genreIndie');
			localStorage.removeItem('genreMMO');
			localStorage.removeItem('genreRacing');
			localStorage.removeItem('genreRPG');
			localStorage.removeItem('genreSimulation');
			localStorage.removeItem('genreSports');
			localStorage.removeItem('genreStrategy');
			localStorage.removeItem('mainrating');
    	}
    	//if (localStorage.getItem('form') == 'changeAllowed' || localStorage.getItem('form') == 'changeAdmin') {
    	//	var formData =  new FormData();
      	//	formData.append($(localStorage.getItem('user') + ".allowed:checkbox", localStorage.getItem('allowed'));
      	//	formData.append($(localStorage.getItem('user') + ".admin:checkbox", localStorage.getItem('admin'));
      	//	var xhr = new XMLHttpRequest();
	//	xhr.open('POST', 'http://wasdreviews.cs.ut.ee/index.php/games/add', true);
	//	xhr.send(formData);
        //	xhr.onreadystatechange = function() {
    	//	if (xhr.readyState == XMLHttpRequest.DONE) {
        //
        //	}
    	//	}
    	//	localStorage.removeItem('form');
    	//	localStorage.removeItem('allowed');
	//	localStorage.removeItem('admin');
	//	localStorage.removeItem('user');
    	//}	
}
