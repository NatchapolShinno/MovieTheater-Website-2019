//Clone the hidden element and shows it
$('#credit').click(function(){
	$('.payment-form').html("");
	$('.credit-form').first().clone().appendTo('.payment-form').show();
  //attach_delete();
});

$('#debit').click(function(){
	$('.payment-form').html("");
	$('.debit-form').first().clone().appendTo('.payment-form').show();
  //attach_delete();
});

$('#paypal').click(function(){
	$('.payment-form').html("");
	$('.paypal-form').first().clone().appendTo('.payment-form').show();
  //attach_delete();
});

$('#cash').click(function(){
	$('.payment-form').html("");
  //attach_delete();
});
