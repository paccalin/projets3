window.setInterval(ping,500);
function ping(){
	$.ajax({
		url : "http://192.168.1.136/",
		type : 'GET',
		success: function (response) {
			$('#connecte').text('Connecté');
		},
		error: function (xhr, ajaxOptions, thrownError) {
			$('#connecte').text('Non cnonnecté');
		}
	})
}
