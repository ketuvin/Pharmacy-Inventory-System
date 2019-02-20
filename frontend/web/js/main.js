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

$(function(){
	$('.modalButtonCategory').click(function(e){
		e.preventDefault();
		$('#modalCategory').modal('show')
			.find('#editCategory')
			.load($(this).attr('value'));
	});
});

$(function(){
	$('.modalButtonViewProduct').click(function(e){
		e.preventDefault();
		$('#modalViewProduct').modal('show')
			.find('#viewProduct')
			.load($(this).attr('value'));
	});
});

$(function(){
	$('.modalButtonUpdateProduct').click(function(e){
		e.preventDefault();
		$('#modalUpdateProduct').modal('show')
			.find('#updateProduct')
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