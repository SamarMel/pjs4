$(document).ready(() => {
	let modify = $("#modify");
	let remarque = $("#remarque");

	let id = $(".data").first().attr("id").replace("id", "");

	let editing = false;
	modify.click(() => {
		if (editing) {
			remarque.attr (
				{
					"disabled" : true
				}
			);
			let rmq = remarque.val();
			$.ajax(`/?controller=ajax&action=updateRemarque&id=${id}&rmq=${rmq}`);
			modify.html("Modifier");
		} else {
			remarque.attr (
				{
					"disabled" : false
				}
			);
			modify.html("Sauvegarder");
			remarque.focus();
		}
		editing = !editing;
	});

	$("#accept").click(() => {
		$.ajax(`/?controller=ajax&action=markAccepted&id=${id}`)
			.then(redirect);
	});

	$("#refuse").click(() => {
		$.ajax(`/?controller=ajax&action=markRefused&id=${id}`)
			.then(redirect);
	});

	$("#give-up").click(() => {
		$.ajax(`/?controller=ajax&action=giveUp&id=${id}`)
			.then(redirect);
	});

	$(".doc input").change((event) => {
		let input = event.target;
		let id = input.id.replace("ch", "");
		if (input.checked) {
			$.ajax(`/?controller=ajax&action=markAsGiven&id=${id}`);
		} else {
			$.ajax(`/?controller=ajax&action=markAsNotGiven&id=${id}`);
		}
	});

	$("#add-doc").click(() => {
		let name = $("#new-doc-name").val();
		if (name.length === 0) {
			alert("Veuillez donner un nom au document.");
			return;
		}

		let rendu = $("#new-doc-checked").is(":checked");
		$.ajax(`/?controller=ajax&action=addDocument&id=${id}&name=${name}&rendu=${rendu}`)
			.then(() => {
				window.location.replace(`/?controller=user&action=seeDemarche&id=${id}`);
			});
	});

	const redirect = () => {
		window.location.replace("/?controller=user&action=demarches");
	};
});