<?php
   require_once($_SERVER["DOCUMENT_ROOT"] . "/class/paypal_checkout.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");
	$paypal = new Paypal_checkout;
?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/popper.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      <script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>
      <script src="https://www.paypalobjects.com/api/checkout.js"></script>
   </head>
   <body>
      <?php 
         include_once($_SERVER["DOCUMENT_ROOT"] . "/template/header.php");
         include_once($_SERVER["DOCUMENT_ROOT"] . "/template/checkout.php");
         include_once($_SERVER["DOCUMENT_ROOT"] . "/template/footer.php");
      ?>
   </body>
</html>





















<script>

$("#paypal-offer-1").hide();
$("#paypal-offer-2").hide();
$("#paypal-offer-3").hide();
$("#paypal-offer-4").hide();
$("#cancel-payment").hide();


// Script for the first offer.

$("#button-offer-1").click(function()
{
	$("#shopping-cart-item").html("<p class='card-text' id='shopping-cart-item'>Coin x 200</p>");
	$("#item-price").html("<p>Total : 2€</p>");
	$("#paypal-offer-1").hide();
	$("#paypal-offer-2").hide();
	$("#paypal-offer-3").hide();
	$("#paypal-offer-4").hide();
	$("#paypal-offer-1").show();
	$("#cancel-payment").show();
});

// Script for the second offer.

$("#button-offer-2").click(function()
{
	$("#shopping-cart-item").html("<p class='card-text' id='shopping-cart-item'>Coin x 500</p>");
	$("#item-price").html("<p>Total : 5€</p>");
	$("#paypal-offer-1").hide();
	$("#paypal-offer-2").hide();
	$("#paypal-offer-3").hide();
	$("#paypal-offer-4").hide();
	$("#paypal-offer-2").show();
	$("#cancel-payment").show();
});

// Script for the third offer.

$("#button-offer-3").click(function()
{
	$("#shopping-cart-item").html("<p class='card-text' id='shopping-cart-item'>Coin x 1000</p>");
	$("#item-price").html("<p>Total : 10€</p>");
	$("#paypal-offer-1").hide();
	$("#paypal-offer-2").hide();
	$("#paypal-offer-3").hide();
	$("#paypal-offer-4").hide();
	$("#paypal-offer-3").show();
	$("#cancel-payment").show();
});
// Script for the fourth offer.

$("#button-offer-4").click(function()
{
	$("#shopping-cart-item").html("<p class='card-text' id='shopping-cart-item'>Coin x 2000</p>");
	$("#item-price").html("<p>Total : 20€</p>");
	$("#paypal-offer-1").hide();
	$("#paypal-offer-2").hide();
	$("#paypal-offer-3").hide();
	$("#paypal-offer-4").hide();
	$("#paypal-offer-4").show();
	$("#cancel-payment").show();
});

// Cancel the payment & reset the cart

$("#cancel-payment").click(function()
{
	$("#shopping-cart-item").html("<p class='card-text' id='shopping-cart-item'>Votre pannier est vide.</p>");
	$("#item-price").html("<p>Total : 0€</p>");
	$("#paypal-offer-1").hide();
	$("#paypal-offer-2").hide();
	$("#paypal-offer-3").hide();
	$("#paypal-offer-4").hide();
	$("#cancel-payment").hide();
});

// Render the PayPal button
paypal.Button.render({
// Set your environment
env: 'sandbox', // sandbox | production
// Specify the style of the button
style: {
  layout: 'vertical',  // horizontal | vertical
  size:   'responsive',    // medium | large | responsive
  shape:  'rect',      // pill | rect
  color:  'black'       // gold | blue | silver | white | black
},
// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
funding: 
{
  allowed: [
    paypal.FUNDING.CARD
  ],
  disallowed: []
},
// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
client:
{
  sandbox: '<?php echo $paypal->paypal_public(); ?>',
  production: '<insert production client id>'
},
payment: function (data, actions) 
{
	return actions.payment.create(
	{
    	payment: 
    	{ 
    		transactions: 
    		[{
    			amount: { total: '2.00', currency: 'EUR' }
    		}]
    	}
  	});
},
onAuthorize: function (data, actions)
{
	return actions.payment.execute().then(function()
    {
    	$.post('script/process_payment.php',
        {
        	payment_id : data.paymentID,
            payment_token : data.paymentToken,
            payer_id : data.payerID
        },
        function(resp)
        {

            	$("#result-checkout").html("<p class='alert alert-success text-center' role='alert'>"+resp+"</p>");

        },);
    });
}
}, '#paypal-offer-1');


// offer 2

paypal.Button.render({
// Set your environment
env: 'sandbox', // sandbox | production

// Specify the style of the button
style: {
  layout: 'vertical',  // horizontal | vertical
  size:   'responsive',    // medium | large | responsive
  shape:  'rect',      // pill | rect
  color:  'black'       // gold | blue | silver | white | black
},

// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
funding: 
{
  allowed: [
    paypal.FUNDING.CARD,
    paypal.FUNDING.CREDIT
  ],
  disallowed: []
},

// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
client:
{
  sandbox: 'AacnVrI4ghRI_3QNcF3e4uYqAHr7LOO0bkZdYK2WhxfTkAw1xgJzPn0F2RNv890v0QKfoCvsIoQECcGU',
  production: '<insert production client id>'
},

payment: function (data, actions) 
{
	return actions.payment.create(
	{
    	payment: 
    	{ 
    		transactions: 
    		[{
    			amount: { total: '5.00', currency: 'EUR' }
    		}]
    	}
  	});
},

onAuthorize: function (data, actions)
{
  return actions.payment.execute().then(function()
    {
      $.post('script/process_payment.php',
        {
          payment_id : data.paymentID,
            payment_token : data.paymentToken,
            payer_id : data.payerID
        },
        function(resp)
        {

              $("#result").html("<p class='alert alert-success' role='alert'>"+resp+"</p>");

        },);
    });
}
}, '#paypal-offer-2');


//offer 3

paypal.Button.render({
// Set your environment
env: 'sandbox', // sandbox | production

// Specify the style of the button
style: {
  layout: 'vertical',  // horizontal | vertical
  size:   'responsive',    // medium | large | responsive
  shape:  'rect',      // pill | rect
  color:  'black'       // gold | blue | silver | white | black
},

// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
funding: 
{
  allowed: [
    paypal.FUNDING.CARD,
    paypal.FUNDING.CREDIT
  ],
  disallowed: []
},

// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
client:
{
  sandbox: 'AacnVrI4ghRI_3QNcF3e4uYqAHr7LOO0bkZdYK2WhxfTkAw1xgJzPn0F2RNv890v0QKfoCvsIoQECcGU',
  production: '<insert production client id>'
},

payment: function (data, actions) 
{
	return actions.payment.create(
	{
    	payment: 
    	{ 
    		transactions: 
    		[{
    			amount: { total: '10.00', currency: 'EUR' }
    		}]
    	}
  	});
},

onAuthorize: function (data, actions)
{
  return actions.payment.execute().then(function()
    {
      $.post('script/process_payment.php',
        {
          payment_id : data.paymentID,
            payment_token : data.paymentToken,
            payer_id : data.payerID
        },
        function(resp)
        {

              $("#result").html("<p class='alert alert-success' role='alert'>"+resp+"</p>");

        },);
    });
}
}, '#paypal-offer-3');

// offer 4

paypal.Button.render({
// Set your environment
env: 'sandbox', // sandbox | production

// Specify the style of the button
style: {
  layout: 'vertical',  // horizontal | vertical
  size:   'responsive',    // medium | large | responsive
  shape:  'rect',      // pill | rect
  color:  'black'       // gold | blue | silver | white | black
},

// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
funding: 
{
  allowed: [
    paypal.FUNDING.CARD,
    paypal.FUNDING.CREDIT
  ],
  disallowed: []
},

// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
client:
{
  sandbox: 'AacnVrI4ghRI_3QNcF3e4uYqAHr7LOO0bkZdYK2WhxfTkAw1xgJzPn0F2RNv890v0QKfoCvsIoQECcGU',
  production: '<insert production client id>'
},

payment: function (data, actions) 
{
	return actions.payment.create(
	{
    	payment: 
    	{ 
    		transactions: 
    		[{
    			amount: { total: '20.00', currency: 'EUR' }
    		}]
    	}
  	});
},

onAuthorize: function (data, actions)
{
  return actions.payment.execute().then(function()
    {
      $.post('script/process_payment.php',
        {
          payment_id : data.paymentID,
            payment_token : data.paymentToken,
            payer_id : data.payerID
        },
        function(resp)
        {

              $("#result").html("<p class='alert alert-success' role='alert'>"+resp+"</p>");

        },);
    });
}
}, '#paypal-offer-4');
</script>
