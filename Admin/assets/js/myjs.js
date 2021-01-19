$(document).ready(function() 
{
    $('table').DataTable();

    $('.editcategory').click(function(){
        $('#categoryid').val($(this).data('id'));
        $('#categoryname').val($(this).data('value'));
        $("#updatecatmsg").html("");
    });

    $('.status').click(function(){
        let id=$(this).data('id');
        let status=$(this).data('status');
        console.log(id);
        $.ajax({
            url: 'editcategory.php',
            method: 'POST',
            data: {id,status},
            dataType: 'html',
            success: function(result)
            {
                if(result==1)
                    location.reload();
                else alert("Operation Failed!!!");
            },
            error: function()
            {
                alert("error");
            }
        }); 

    });

    $('#updatecat').click(function(){
        let id=$('#categoryid').val();
        let name=$('#categoryname').val();
        $.ajax({
            url: 'editcategory.php',
            method: 'POST',
            data: {id,name},
            dataType: 'html',
            success: function(result)
            {
                $("#updatecatmsg").html("<p style='color:#172b4d;' class='mb-0'>"+result+"</p>");
                $('.close').click(function(){
                location.href="createcategory.php";
                    });
            },
            error: function()
            {
                $("#updatecatmsg").html("<p style='color:red;' class='mb-0'>Some error occured</p>");
            }
        });   
    });
}); 
function validatecategory()
{
    $("#category").val($("#category").val().trim());
    let a=$('#category').val();
    let err=0;
    if(a=="")
    {
        err=1;
        $("#categorymsg").html('** This is reqired field');
    }
    else if(!isNaN(a))
    {
        err=1;
        $("#categorymsg").html('** only Alphabetic/Alphanumeric values allowed'); 
    }
    else if(!/^\d*[a-z\-A-Z.]([ ]?[a-zA-Z0-9.])*$/.test(a))
    {
        err=1;
        $("#categorymsg").html("** Only '.' allowed as special character"); 
    }
    if(err==0)
    {
        $("#category").removeClass("errorfield");
        $("#categorymsg").html('');
        return true;
    }
    else
    {
        $("#category").addClass('errorfield');
        return false;
    }
}
function validateproductcat()
{
    let a=$('#productcat').val();
    if(a==null)
    {
        $("#productcat").addClass('errorfield');
        $("#productcatmsg").html('** This is required field');
        $("#create").attr('disabled','disabled');
    }
    else
    {
        $("#productcatmsg").html('');
        $("#productcat").removeClass('errorfield');
        $("#create").removeAttr('disabled');
    }
}
function validateproductname()
{
    $("#productname").val($("#productname").val().trim());
    let a=$('#productname').val();
    let pattern=/^\d*[a-z\-A-Z][a-zA-Z\d \-]*$/;
    if(pattern.test(a))
    {   
        $("#productname").removeClass("errorfield");
        $("#productnamemsg").html('');
        $("#create").removeAttr('disabled');
    }
    else 
    {
        $("#productname").addClass('errorfield');
        if(a=="")
            $("#productnamemsg").html('** This is required field');
        else if(!(isNaN(a)))
        {
            $("#productnamemsg").html('** Number cannot be entered.');
        }
        else 
            $("#productnamemsg").html("** only - allowed as special character.");
        $("#create").attr('disabled','disabled');
    }
}
function validateprice(id,msg)
{
    let a=$(id).val();
    let pattern=/^[0-9.]{1,15}$/;
    if(a=="" || a<0 ||a==0 || a.indexOf('e')!=-1 || a.indexOf('E')!=-1)
    {   
        if(a=="")
            $(msg).html("** This is required field");
        else if(a<0)
            $(msg).html("** Invalid Price");
        else if(a==0)
            $(msg).html("** Cannot be 0");
        else if(a.indexOf('e')!=-1 || a.indexOf('E')!=-1)
            $(msg).html("** Invalid Price");
        $(id).addClass('errorfield');
        $("#create").attr('disabled','disabled');
    }
    else
    {
        if(pattern.test(a))
        {
            let err=0;
            if(a.charAt(0)==".")
            {
                if(a.length<15)
                    $(id).val('0'+a);
                else
                {
                    $(msg).html("** Max limit 15 characters");
                    err=1;
                }
            }
            if(err==0)
            {
                $(id).removeClass("errorfield");
                $(msg).html('');
                $("#create").removeAttr('disabled');
            }
            else
            {
                $(id).addClass('errorfield');
                $("#create").attr('disabled','disabled');
            }
        }
        else
        {
            $(msg).html("** Max limit 15 characters");
            $(id).addClass('errorfield');
            $("#create").attr('disabled','disabled');
        }
    }
}
function validatesku()
{
    let pattern=/^[a-zA-Z0-9#\-]([ ]?[a-zA-Z0-9#\-]){1,}$/gi;
    let pattern2=/^[#\-]+$/;
    $("#sku").val($("#sku").val().trim());
    let a=$("#sku").val();
    let err=0;
    if(a=="")
    {
        $("#skumsg").html("** This is required field");
        err=1;
    }
    else if(pattern2.test(a))
    {
        $("#skumsg").html("** Can not be of only special characters");
        err=1;
    }
    else if(!pattern.test(a))
    {
        $("#skumsg").html("** only allowed '#', '-' special character");
        err=1;
    }
    if(err==0)
    {
        $("#sku").removeClass("errorfield");
        $("#skumsg").html('');
        $("#create").removeAttr('disabled');
    }
    else
    {
        $("#sku").addClass('errorfield');
        $("#create").attr('disabled','disabled');
    }
}
function validategb(id,msg)
{
    let a=$(id).val();
    let pattern=/^[0-9.]{1,5}$/;
    if(a=="" || a<0 ||a==0 || a.indexOf('e')!=-1 || a.indexOf('E')!=-1)
    {   
        if(a=="")
            $(msg).html("** This is required field");
        else if(a<0)
            $(msg).html("** Invalid Number");
        else if(a==0)
            $(msg).html("** Cannot be 0");
        else if(a.indexOf('e')!=-1 || a.indexOf('E')!=-1)
            $(msg).html("** Invalid number");
        $(id).addClass('errorfield');
        $("#create").attr('disabled','disabled');
    }
    else
    {
        if(pattern.test(a))
        {
            let err=0;
            if(a.charAt(0)==".")
            {
                if(a.length<5)
                    $(id).val('0'+a);
                else
                {
                    $(msg).html("** Max limit 5 characters");
                    err=1;
                }
            }
            if(err==0)
            {
                $(id).removeClass("errorfield");
                $(msg).html('');
                $("#create").removeAttr('disabled');
            }
            else
            {
                $(id).addClass('errorfield');
                $("#create").attr('disabled','disabled');
            }
        }
        else
        {
            $(msg).html("** Max limit 5 characters");
            $(id).addClass('errorfield');
            $("#create").attr('disabled','disabled');
        }
    }
}
function validatedomain(id,msg)
{
    $(id).val($(id).val().trim());
    let a=$(id).val(); 
    let err=0;
    if(a=="")
    {
        $(msg).html("** This is required field");
        err=1;
    }
    else if(/^(?=.*[a-zA-Z])(?=.*[0-9])[A-Za-z0-9]+$/.test(a))
    {
        $(msg).html("** can not be alphanumeric");
        err=1;
    }
    else if(!/^([0-9]+|[a-zA-Z]+)$/.test(a))
    {
        $(msg).html("** No whitespaces and '.' allowed");
        err=1;
    }
    if(err==0)
    {
        $(id).removeClass("errorfield");
        $(msg).html('');
        $("#create").removeAttr('disabled');
    }
    else
    {
        $(id).addClass('errorfield');
        $("#create").attr('disabled','disabled');
    }
}
function validatelang()
{
    $("#lang").val($("#lang").val().trim());
    let a=$("#lang").val();
    if(a.charAt(a.length-1)==",")
    {
        a=a.slice(0,a.length-1);
        $("#lang").val(a);
    }
    let err=0;
    if(a=="")
    {
        $("#langmsg").html("** This is required field");
        err=1;
    }
    else if(!isNaN(a))
    {
        $("#langmsg").html("** Only alphabetic/alphanumeric values allowed");
        err=1;   
    }
    else if(!/^\d*[a-z\-A-Z]([,]?[a-zA-Z0-9]){1,}$/.test(a))
    {
        $("#langmsg").html("** Only ',' allowed as special character");
        err=1;   
    }
    if(err==0)
    {
        $("#lang").removeClass("errorfield");
        $("#langmsg").html('');
        $("#create").removeAttr('disabled');
    }
    else
    {
        $("#lang").addClass('errorfield');
        $("#create").attr('disabled','disabled');
    }
}