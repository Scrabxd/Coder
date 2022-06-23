$("input").on('focusout', function(){
	$(this).each(function(i, e){
		if($(e).val() != ""){
			$(e).addClass('not-empty');
		}else{
			$(e).removeClass('not-empty');
		}
	});
});

$(".login").on('click', function(){
	$(this).animate({
		fontSize : 0
	}, 300, function(){
		$(".check").addClass('in');
	});
});