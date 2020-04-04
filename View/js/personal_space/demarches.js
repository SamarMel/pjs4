$(document).ready(() => {
	$(".complete a").click((event) => {
		let id = event.target.id.replace("del-", "");
		$.ajax(`/?controller=ajax&action=deleteDemarche&id=${id}`)
			.then(() => {
				location.reload();
			});
	});
});