$(document).ready( function () {
    console.log("aman");
    $('table').DataTable();
} );

function validatereg()
{
    let err=0;
    let name=document.getElementById('name');
    let email=document.getElementById('email');
    let mobile=document.getElementById('mobile');
    let nameerr=document.getElementById('nameerror');
    let emailerr=document.getElementById('emailerror');
    let mobileerr=document.getElementById('mobileerror');
    let emailcheck=/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    let emailvalue=email.value;
    if(emailvalue.includes(".."))
    {
    	emailerr.innerHTML="* can not have ..";
    	err=1;
    }
    if(emailvalue.includes(" "))
    {
    	emailerr.innerHTML="* white spaces not allowed";
    	err=1;
    }
    if(emailcheck.test(emailvalue))
    {
		emailerr.innerHTML="";
    }
    else
    {
        emailerr.innerHTML="* Incorrect Format";
        return false;
		
    }
    name.value=name.value.trim();
    let namevalue=name.value;
    let namelength=namevalue.length;
    let namecheck=/^[a-zA-Z][a-zA-Z ]{3,30}$/;
	if(namecheck.test(namevalue))
	{
       for(i=0;i<namelength;i++)
       {
           if(namevalue[i]==" ")
           {
               if(namevalue[i+1]==" ")
               {
                   nameerr.innerHTML="* only one space allowed between names";
                   return false;
               }
           }
       }
       nameerr.innerHTML="";
	}
	else
	{
        nameerr.innerHTML="* Name should contain only alphabets and no white spaces allowed.";
        return false;
	}
    let mobilecheck=/^[0-9]{10,11}$/;
    let mobilevalue=mobile.value;
    if(mobilecheck.test(mobilevalue))
    {
        if(mobilevalue.length==11)
        {
            if(mobilevalue[0]!=0)
            {
                mobileerr.innerHTML="* Maximum 11 digits including preceding 0 and max 10 digits excluding preceding 0 allowed";
                return false;
            }
        }
        if(mobilevalue[0]=='0')
        {
            if(mobilevalue[1]=='0')
            {
                mobileerr.innerHTML="* Number should not contain more than one 0's in starting";
                return false;
            }
            if(mobilevalue.length!=11)
            {
                mobileerr.innerHTML="* Maximum 11 digits including preceding 0 and max 10 digits excluding preceding 0 allowed";
                return false;
            }
        }
        if(allCharactersSame(mobilevalue))
        {
            mobileerr.innerHTML="* All digits can't be same";
            return false;           
        }
        mobileerr.innerHTML="";
    }
    else
    {
        mobileerr.innerHTML="* Invalid Number";
        return false;
    }
}


function allCharactersSame(a)
{
    var n = a.length;
    for (i = 1; i < n; i++)
        if (a[i] != a[0])
            return false;
    return true;
}
    function validatepassword()
    {
        let password=document.getElementById('password');
        let conpassword = document.getElementById('conpassword');
        let passworderr=document.getElementById('passworderr');
        let conpassworderr=document.getElementById('conpassworderr');

        let passwordvalue=password.value;
        let conpasswordvalue=conpassword.value;
        let passwordcheck=/^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,16}$/;
        console.log(passwordvalue.length);
        if(!(passwordvalue.length>=8 && passwordvalue.length<=16))
        {
            passworderr.innerHTML="* Length should be between 8 and 16";
            return false;
        }
        if(passwordvalue.includes(" "))
        {
            passworderr.innerHTML="* white spaces not allowed";
            return false;
        }
        if(!passwordcheck.test(passwordvalue))
        {
           passworderr.innerHTML="* Should be combination of upper case, lower case, special characters and digits.";
           return false;
        }
        else
        {
           passworderr.innerHTML="";        
        }
        if(conpasswordvalue!=passwordvalue)
        {
            conpassworderr.innerHTML="* Password does not match";
            return false;
        }
        else
        {
            conpassworderr.innerHTML="";
        }
    }

function validateques()
{
    let answer=document.getElementById('answer');
    let answererr=document.getElementById('answererror');
    answer.value=answer.value.trim();
    let answercheck=/^\d*[a-zA-Z][a-zA-Z\d]*$/;
    let answervalue=answer.value;
    if(!isNaN(answervalue))
    {
        answererr.innerHTML="* Number not allowed";
        return false;

    }
    if(answervalue.includes(" "))
    {
        answererr.innerHTML="* No whites Spaces allowed.";
        return false;       
    }
    if(!answercheck.test(answervalue))
    {
       answererr.innerHTML="* Can be alpha-numeric/alphabetic. Is CASE-SENSITIVE";
        return false;
    }
    else
    {
       answererr.innerHTML="";      
    }

}