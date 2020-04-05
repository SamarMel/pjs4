$(document).ready(() => {
	$('input[type="radio"]').click(() => {
		let val = $(this).attr("value");
		let target = $("." + val);
		$(".msg").not(target).hide();
		$(target).show();
	});
	
	$("select").change(function() {
		$(this).find("option:selected").each(() => {
			let val = $(this).attr("value");
			if (val) {
				$(".msgs").not("." + val).hide();
				$("." + val).show();
			} else {
				$(".msgs").hide();
			}
		});
	}).change();
	
	$('input[type="checkbox"]').click(() => {
		let val = $(this).attr("value");
		$("." + val).toggle();
	});
});