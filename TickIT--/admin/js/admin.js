$(document).ready(function(){
	$('#show_type').change(function(){
		var val = $(this).val();
		var price = $('#price').val() === "" ? 0 : $('#price').val();
		$.ajax({
			type: "GET",
			url: "includes/getdata.php",
			data: {
				prices		: price,
				showType	: val
			},
			success: function(data)
			{
				$("#totalPrice").html(data);
			}
		});
	});

	$('#price').blur(function(){
		var price = $(this).val() === "" ? 0 : $('#price').val();
		var val = $('#show_type').val();
		$.ajax({
			type: "GET",
			url: "includes/getdata.php",
			data: {
				prices		: price,
				showType	: val
			},
			success: function(data)
			{
				$("#totalPrice").html(data);
			}
		});
	});

	$('#plane').change(function(){
		var val = $(this).val();
		$.ajax({
			type: "GET",
			url: "includes/getdata.php",
			data: {
				idPlane: val
			},
			success: function(data)
			{
				$('#seat').html(data);
			}
		})
	});
});