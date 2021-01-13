let payableprice=0;
let comstate=$("#comstate").val();
let st=0;
let taxammount=0;
console.log(comstate);
$("#state").change(function(){
	tp=parseFloat($('#totalprice').text());
	st=$("#state").val();
	if(comstate==st)
	{
		
		cgst=9*tp/100;
		sgst=9*tp/100;
		tp=tp+cgst+sgst;
		tp=Math.round(tp);
		taxammount=Math.round(cgst+sgst);
	}
	else
	{
		igst=18*(tp)/100;
		taxammount=igst;
		tp=tp+igst;
		tp=Math.round(tp);
		taxammount=Math.round(igst);
	}
	payableprice=tp;
console.log(taxammount);
});

let status='';
paypal.Buttons({
	style:{
		color:'blue',
		maxwidth:'100px'
	},
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: tp
            //currency_code: 'USD'
            //'currency':'INR'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        //alert('Transaction completed by ' + details.payer.name.given_name);
        console.log(details);
        $('#orderid').text(details.id);
        if(details.status=="COMPLETED")
        {
		    let hno=$("#hno").val();
		    let city=$("#city").val();
		    let state=$("#state").val();
		    let pincode=$("#pincode").val();
		    let country=$("#country").val();

		    $.ajax({
		        url: 'order.php',
		        method: 'POST',
		        data: {hno,city,state,pincode,country,taxammount},
		        dataType: 'html',
		        success: function(result)
		        {

		            $("#orderid").html("<p style='margin-left:20px; font-size:large; margin-top:20px;'>"+result+"</p>");
		        },
		        error: function()
		        {
		            $("#orderid").html("<p style='margin-left:20px; font-size:large; margin-top:20px;'>>Some error occured</p>");
		        }
		    });        	
        }
      });
    }
}).render('#paypal-button-container');

// $('#paypal-button-container').click(function(){
//     let hno=$("#hno").val();
//     let city=$("#city").val();
//     let state=$("#state").val();
//     let pincode=$("#pincode").val();
//     let country=$("#country").val();

//     $.ajax({
//         url: 'order.php',
//         method: 'POST',
//         data: {hno,city,state,pincode,country},
//         dataType: 'html',
//         success: function(result)
//         {

//             $("#orderid").html("<p style='margin-left:20px; font-size:large; margin-top:20px;'>"+result+"</p>");
//         },
//         error: function()
//         {
//             $("#orderid").html("<p style='margin-left:20px; font-size:large; margin-top:20px;'>>Some error occured</p>");
//         }
//     });
// });