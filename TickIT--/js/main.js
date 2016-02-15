$(document).ready(function(){
	$('.ticketFor').change(function(){
		var name = $('.ticketFor').val();
		if(name != "")
		{
			var idSeat = $('#idSeat').val();
			var boxSeat = document.getElementById('boxSeat-'+idSeat);
			alert(boxSeat);
			boxSeat.style.backgroundColor = 'grey';
		}
	});
});