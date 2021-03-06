$('.address').click(function(){
    createprice();
    let id=$(this).val();
    let address='fetchaddress';
    $.ajax({
      url:'order.php',
      method: 'POST',
      data: {id,address},
      dataType: 'json',
      success: function(result)
      {
        $("#country").val(result[0].country);
        $("#state").val(result[0].state);
        $("#pincode").val(result[0].pincode);
        $("#hno").val(result[0].house_no);
        $("#country").val(result[0].country);
        $("#city").val(result[0].city);
      },
      error: function()
      {
        alert ("error");
      }
    });   
});
$('.bill').focus(function(){
    $('.address').attr('checked',false);
});
function createprice()
{
    tp=Math.round($('#totalprice').text());
    st=$("#state").val();
    if(comstate==st)
    {
        trans=1;
        cgst=Math.round(cgstrate*tp/100);
        sgst=Math.round(sgstrate*tp/100);
        tp=tp+cgst+sgst;
        tp=Math.round(tp);
        taxammount=Math.round(cgst+sgst);
    }
    else
    {
    trans=0;
        igst=Math.round(igstrate*(tp)/100);
        taxammount=igst;
        tp=tp+igst;
        tp=Math.round(tp);
        taxammount=Math.round(igst);
    }
    payableprice=tp;
}
let payableprice=0;
let comstate=$("#comstate").val();
let st=0;
let igstrate=18;
let cgstrate=9;
let sgstrate=9;
let taxammount=0;
let status='';
let trans='';
let cgst=0;
let sgst=0;
let igst=0;
$("#state").change(function(){
    createprice();
});
$('#cod').click(function(){
	let status="PENDING";
	let condition=validate();
	if(condition==0)
		placingorder(status);
});

function validate()
{
	let err=0;
	let hno=$("#hno").val();
    let city=$("#city").val();
    let state=$("#state").val();
    let pincode=$("#pincode").val();
    let country=$("#country").val();
    if(hno==null || hno=='')
    {
    	$("#hnomsg").html("<small class='billaddressform'>** Required Field</small>");
    	err=1;
    }
    else $("#hnomsg").html("");
    if(city==null || city=='')
    {
    	$("#citymsg").html("<small class='billaddressform'>** Required Field</small>");
    	err=1;
    }
   	else $("#citymsg").html("");    
    if(state==null || state=='')
    {
    	$("#statemsg").html("<small class='billaddressform'>** Required Field</small>");
    	err=1;
    }
    else $("#statemsg").html("");    
    if(pincode==null || pincode=='')
    {
    	$("#pincodemsg").html("<small class='billaddressform'>** Required Field</small>");
    	err=1;
    }
    else $("#pincodemsg").html("");    
    if(country==null || country=='')
    {
    	$("#countrymsg").html("<small class='billaddressform'>** Required Field</small>");
    	err=1;
    }
    else $("#countrymsg").html("");    
    return err;
}

paypal.Buttons({
    style:{
        color:'blue',
        maxwidth:'100px'
    },
    createOrder: function(data, actions) {
            let condition=validate();
            if(condition==0)
        {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: payableprice,
            //currency_code: 'USD'
            //'currency':'INR'
          }
        }]
      });
    }
    },
    onApprove: function(data, actions) {    
      let condition;
      condition=validate();
      if(condition==0)
      {
          //console.log(actions);
          // This function captures the funds from the transaction.
          return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
            //alert('Transaction completed by ' + details.payer.name.given_name);
            console.log(details);
            // $('#orderid').text(details.id);
            if(details.status=="COMPLETED")
            {
                status=details.status
                  placingorder(status,details.id);
            }
            else
            {
                window.location.href = "fail.php";
            }
          });
        }
    }
}).render('#paypal-button-container');


function placingorder(status,txnid=0)
{
	let hno=$("#hno").val();
    let city=$("#city").val();
    let state=$("#state").val();
    let pincode=$("#pincode").val();
    let country=$("#country").val();
    let orderstatus=status;
    $.ajax({
      url:'order.php',
      method: 'POST',
      data: {hno,city,state,pincode,country,taxammount,payableprice,orderstatus,igst,cgst,sgst,txnid},
      dataType: 'json',
      success: function(result)
      {
        console.log(result);
        if(result.res=="success")
        {
          console.log(result);
          location.replace('success.php?igst='+igst+'&cgst='+cgst+'&sgst='+sgst+'&trans='+trans+'&id='+result.orderid);		
        }
        else if(result.res=="fail")
        {
          window.location.replace("fail.php");
        }
      },
      error: function()
      {
        alert ("error");
      }
    });     	
}
