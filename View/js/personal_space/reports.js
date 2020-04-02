$(document).ready(() => {
	
	$("input[type='checkbox']").change((event) => {
			let id = event.target.id.replace("filter", "");
			let t = event.target.checked ? 1 : 0;
			$.ajax(`/?controller=ajax&action=traiter&id=${id}&t=${t}`);
	});
	
	$("#filter-div").change((event) => {
		let filter = event.target.checked ? "0" : "";
		document.location = `/?controller=user&action=gerer&filter=${filter}`;
	});
	
	$(".ban").click ((event) => {
		let id = event.target.id.replace("ban", "");
		$.ajax(`/?controller=ajax&action=ban&id=${id}`)
			.then(() => {
				location.reload();
			});
	});
	
	$(".see").click ((event) => {
		event.preventDefault();
		let idJSON = JSON.parse(event.target.id);
		let id = idJSON.id;
		let idPost = idJSON.idPost;
		document.location = `/?controller=forum&action=seeTopic&id=${id}#post-${idPost}`;
	});
	
});