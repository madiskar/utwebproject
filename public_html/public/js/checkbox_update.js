$("input[type='checkbox']").change(function() {
	var formData = new FormData();
	var admin = $("input[id|='" + $(this).attr("id") + "'][name|='admin']").is(':checked')==true ? "1" : "0";
	var allowed = $("input[id|='" + $(this).attr("id") + "'][name|='allowed']").is(':checked')==true ? "1" : "0";
	var id = $(this).attr("id");
	formData.append('allowed', allowed);
	formData.append('admin', admin);
    var xhr = new XMLHttpRequest();
	xhr.open('POST', 'http://wasdreviews.cs.ut.ee/index.php/admin/update_users/' + id, true);
	xhr.send(formData);
});