$(document).ready(function() {
	$('#frmemail').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: '/?controller=ajax&action=sendMail',
			data: $('#frmemail').serialize()
		}).then(() => {
			alert("Message envoyé.");
			window.location.replace("/");
		});
	});
});