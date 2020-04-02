$(document).ready(() => {
	let modify = $("#modify");
	let remarque = $("#remarque");
	
	let editing = false;
	modify.click((event) => {
		let id = event.target.parentNode.id;
		if (editing) {
			remarque.attr(
				{
					"disabled" : true
				}
			);
			let rmq = remarque.val();
			$.ajax(`/?controller=ajax&action=updateRemarque&id=${id}&rmq=${rmq}`);
			modify.html("Modifier");
		} else {
			remarque.attr(
				{
					"disabled" : false
				}
			);
			modify.html("Sauvegarder");
			remarque.focus();
		}
		editing = !editing;
	});
});