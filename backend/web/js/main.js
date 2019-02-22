$(function(){
	$('#modalButton').click(function (){
		$('#modalUser').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
});

$(function(){
	$('.modalButtonView').click(function(e){
		e.preventDefault();
		$('#modalView').modal('show')
			.find('#viewContent')
			.load($(this).attr('href'));
	});
});

$(function(){
	$('.modalButtonViewDeposit').click(function(e){
		e.preventDefault();
		$('#modalViewDeposit').modal('show')
			.find('#viewContentDeposit')
			.load($(this).attr('href'));
	});
});