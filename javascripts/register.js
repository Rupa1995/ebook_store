
//getting input text object
  var username = document.forms["vform"]["username"];
  var mobile = document.forms["vform"]["mobile"];
  var password = document.forms["vform"]["password"];
  var password_confirmation = document.forms["vform"]["password_confirmation"];
  var username_login = document.forms["vform1"]["username_login"];
  var password_login = document.forms["vform1"]["password_login"];
  //var mobile = document.forms["vform"]["mobile"];

  //getting error display object
  var login_name_error = document.getElementById("login_name_error");
  var email_error = document.getElementById("email_error");
  var number_error = document.getElementById("number_error");
  var password_error = document.getElementById("password_error");
  var login_password_error = document.getElementById("login_password_error");

  //var mobile_error = document.getElementById("mobile_error");

  //setting all event listener
  username_login.addEventListener("blur", lognameVerify, true);
  password_login.addEventListener("blur", logpassVerify, true);
  username.addEventListener("blur", nameVerify, true);
  mobile.addEventListener("blur", mobileVerify, true);
  password.addEventListener("blur", passwordVerify, true);
  //mobile.addEventListener("blur", mobileVerify,true);

 function Validate_login(){

   //username login validation
    if (username_login.value=="") {
      username_login.style.border = "1px solid red";
      login_name_error.textContent = "Username is required";
      username_login.focus();
      return false;
    }
     //password login validation
    if (password_login.value=="") {
      password_login.style.border = "1px solid red";
      login_password_error.textContent = "password is required";
      password_login.focus();
      return false;
    }
  }
  
   function Validate(){
    //username validation
    if (username.value=="") {
      username.style.border = "1px solid red";
      email_error.textContent = "email id is required";
      username.focus();
      return false;
    }
    //email validation
    if (mobile.value=="") {
      mobile.style.border = "1px solid red";
      number_error.textContent = "Mobile number is required";
      mobile.focus();
      return false;
    }
  
    //password validation
    if (password.value=="") {
      password.style.border = "1px solid red";
      password_error.textContent = "password is required";
      password.focus();
      return false;
    }
  }
  



  //event handler func
     function lognameVerify(){
    if(username_login.value !=""){
      username_login.style.border = "1px solid $light-gray";
      login_name_error.innerHTML = "";
      return true;
    }
   } 
       function logpassVerify(){
    if(password_login.value !=""){
      password_login.style.border = "1px solid $light-gray";
      login_password_error.innerHTML = "";
      return true;
    }
   } 

   function nameVerify(){
    if(username.value !=""){
      username.style.border = "1px solid $light-gray";
      email_error.innerHTML = "";
      return true;
    }
   } 

    function mobileVerify(){
    if(mobile.value !=""){
      mobile.style.border = "1px solid $light-gray";
      number_error.innerHTML = "";
      return true;
    }
   } 
    function passwordVerify(){
    if(password.value !=""){
      password.style.border = "1px solid $light-gray";
      password_error.innerHTML = "";
      return true;
    }
   } 
