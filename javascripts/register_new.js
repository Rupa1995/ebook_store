	$('.message a').click(function() {
    $('.form1').animate({height: "toggle", opacity: "toggle"}, "slow");
     $('.form2').animate({height: "toggle", opacity: "toggle"}, "slow");
  }); 
	var passwrd = document.getElementById('password');
	var passwrd_confirm = document.getElementById('password_confirm');
	var mobile = document.getElementById('mobile');
	var error = document.getElementById('errors');
	var error2 = document.getElementById('password_error');
      
function phoneverify()
  {
    var phoneno = /^\+91?\d{10}$/;
    while(mobile.value !=""){
    if(mobile.value.match(phoneno))
    {
       //alert("Phone Number accepted");
        return true;
    }
    else
    {
       error.innerHTML= "enter valid Phone Number";
       mobile.style.border = "1px solid red";
       error.style.color = "red";
       return false;
    }
  }
}

function passwordverify()
{
	if(passwrd.value == passwrd_confirm.value){
		//alert("password match");
		return true;
	}
	else{
		error2.innerHTML="password do not match";
		password_confirm.style.border="1px solid red";
		passwrd.style.border="1px solid red";
		error2.style.color = "red";
	}
}

function resetvalue()
{
  error.innerHTML="";
  mobile.innerHTML="";
  mobile.style.border="";
  error2.innerHTML="";
  passwrd.style.innerHTML="";
  password_confirm.style.border="";
  passwrd.style.border="";
}