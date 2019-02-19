$(function(){
	$('#modalButton').click(function (){
		$('#modalUser').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
});