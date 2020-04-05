$(document).ready(function(){
	$('input[type="radio"]').click(function(){
		var val = $(this).attr("value");
		var target = $("." + val);
		$(".msg").not(target).hide();
		$(target).show();
	});
});


$(document).ready(function(){
	$("select").change(function(){
		$(this).find("option:selected").each(function(){
			var val = $(this).attr("value");
			if(val){
				$(".msgs").not("." + val).hide();
				$("." + val).show();
			} else{
				$(".msgs").hide();
			}
		});
	}).change();
});


$(document).ready(function(){
	$('input[type="checkbox"]').click(function(){
		var val = $(this).attr("value");
		$("." + val).toggle();
	});
});

