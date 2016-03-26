function previewfile(file) {
  if (tests.filereader === true && acceptedTypes[file.type] === true) {
    var reader = new FileReader();
    reader.onload = function (event) {
      var image = new Image();
      image.src = event.target.result;
      image.width = 250; // a fake resize
      holder.appendChild(image);
      holder.innerHTML += '<p>Uploaded ' + file.name + ' ';
      
    };

    reader.readAsDataURL(file);
  }
}

function readfiles(files) {
    debugger;
    for (var i = 0; i < files.length; i++) {
    	var formData = tests.formdata ? new FormData() : null;
      if (tests.formdata) formData.append('userfile', files[i]);
      if (tests.formdata) {
	      var xhr = new XMLHttpRequest();
	      xhr.open('POST', 'http://wasdreviews.cs.ut.ee/index.php/games/do_upload', true);

	      xhr.send(formData);
		  xhr.onreadystatechange = function() {
    if (xhr.readyState == XMLHttpRequest.DONE) {
		screenshots_field.value = screenshots_field.value + xhr.responseText + '|';
    }
}
	    }
		
      previewfile(files[i]);
    }
}

	var holder = document.getElementById('holder'),
    tests = {
      filereader: typeof FileReader != 'undefined',
      dnd: 'draggable' in document.createElement('span'),
      formdata: !!window.FormData
    }, 
    support = {
      filereader: document.getElementById('filereader'),
      formdata: document.getElementById('formdata')
    },
    acceptedTypes = {
      'image/png': true,
      'image/jpeg': true,
      'image/gif': true
    },
    fileupload = document.getElementById('upload'),
    screenshots_field = document.getElementById('screenshots');

	"filereader formdata".split(' ').forEach(function (api) {
	  if (tests[api] === false) {
		support[api].className = 'fail';
	  } else {
		support[api].className = 'hidden';
	  }
	});
	
	
	if (tests.dnd) { 
	  holder.ondragover = function () { this.className = 'hover'; return false; };
	  holder.ondragend = function () { this.className = ''; return false; };
	  holder.ondrop = function (e) {
		this.className = '';
		e.preventDefault();
		readfiles(e.dataTransfer.files);
	  }
	} else {
	  fileupload.className = 'hidden';
	  fileupload.querySelector('input').onchange = function () {
		readfiles(this.files);
	  };
	}