$(function(){
	$('#modalButton').click(function (){
		$('#modal').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
});

$(function(){
	$('#modalButtonWithdraw').click(function (){
		$('#modalWithdraw').modal('show')
			.find('#contentWithdraw')
			.load($(this).attr('value'));
	});
});

$(function(){
	$('#modalButtonUnit').click(function (){
		$('#modalUnit').modal('show')
			.find('#addUnit')
			.load($(this).attr('value'));
	});
});

$(function(){
	$('.modalButtonStock').click(function(e){
		e.preventDefault();
		$('#modalStock').modal('show')
			.find('#addStock')
			.load($(this).attr('value'));
	});
});