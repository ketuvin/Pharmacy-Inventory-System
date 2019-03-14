function init_click_handlers(){

	$(function(){
		$('.modalButtonStock').click(function(e){
			e.preventDefault();
			$('#modalStock').modal('show')
				.find('#addStock')
				.load($(this).attr('href'));
		});
	});

	$(function(){
		$('.modalButtonViewProduct').click(function(e){
			e.preventDefault();
			$('#modalViewProduct').modal('show')
				.find('#viewProduct')
				.load($(this).attr('href'));
		});
	});

	$(function(){
		$('.modalButtonUpdateProduct').click(function(e){
			e.preventDefault();
			$('#modalUpdateProduct').modal('show')
				.find('#updateProduct')
				.load($(this).attr('href'));
		});
	});

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
		$('.modalButtonCategory').click(function(e){
			e.preventDefault();
			$('#modalCategory').modal('show')
				.find('#editCategory')
				.load($(this).attr('href'));
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
		$('#modalButtonVoid').click(function(e){
			$('#modalVoid').modal('show')
				.find('#contentVoid')
				.load($(this).attr('value'));
		});
	});

	$(function(){
		$('.modalButtonViewVoid').click(function(e){
			e.preventDefault();
			$('#modalViewVoid').modal('show')
				.find('#viewVoidContent')
				.load($(this).attr('href'));
		});
	});

	$(function(){
		$('.modalButtonEditUnit').click(function(e){
			e.preventDefault();
			$('#modalEditUnit').modal('show')
				.find('#editUnit')
				.load($(this).attr('href'));
		});
	});

	$(function(){
		$('#modalButtonReport').click(function (){
			$('#modalReport').modal('show')
				.find('#createReport')
				.load($(this).attr('value'));
		});
	});

	$(function(){
		$('#modalButtonWithdrawReport').click(function (){
			$('#modalWithdrawReport').modal('show')
				.find('#createWithdrawalReport')
				.load($(this).attr('value'));
		});
	});
}