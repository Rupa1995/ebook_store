<?php 
  include 'db.php';

   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username_login']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password_login']); 
      
      $sql = "SELECT uname FROM register WHERE uname = '$myusername' and passwrd = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
       
         $_SESSION['login_user'] = $myusername;
         if($myusername == 'Admin@admin'){
          header("location: /admin/home.php");
         }
         else{
            header("location: index.php");
        }
      }
      else {
         $error = "Your Login Name or Password is invalid";
         echo $error;
      }
   }
?> 

<!DOCTYPE html>
<html>
<head>
	<title>register</title>
	<link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="stylesheets/register.css">
</head>
<body id="body_log">
	  <div class="container">
        <div class="header-top">
            <div class="upper-header container">
                <form class="search-form" action="#" method="get">
                    <i class="fa fa-search"></i>
                    <input type="text" name="s" value placeholder="Search by book title..">
                    <input type="hidden" name="post_type" value="product">
                </form>
                <div class="logo">
                    <a href="index.html">
                    	<h1>Books</h1>
                    	<span>ebook store</span>
                    </a>
                </div>  
                <div class="pull-right menu">
                                <div class="right-nav">
                                   <ul class="log">
                                    <li><a href="#">Wishlist</a></li>
                                    <li><a href="#">Cart</a></li>
                                     <li>
                                      <?php 
                                      if(isset($_SESSION['login_user'])){
                                        echo '<a href="logout.php" class="login_user">Logout</a>';
                                        } 
                                        else{ 
                                          echo '<a href="register.php?action=logout" class="register_user">Login/SignUp</a>';
                                          }
                                       ?>
                                    </li>
                                </ul>
                                </div>
                              </div>
            </div>
            <div class="clearfix"></div>
         </div>
    </div>
   
    <div class="container-fluid register-container">
    	<div class="login-box form1">
	           	<div>
	           		<p class="register-title">Log In</p>
	           	</div>
	           	<div class="register-third-party">
	           		<p class="register-btn-info">- EASILY USING -</p>
	           		 <div class="social-login">
      					<a href="#">
        					<i class="fa fa-facebook fa-lg"></i>
        					facebook
      					</a>
      					<a href="#">
       						<i class="fa fa-google-plus fa-lg"></i>
        					Google
      					</a>
    				</div>
	           	</div>
	           	<p class="info-text">- OR USING EMAIL -</p>
	          	<!-- <form class="register-form" enctype="multipart/form-data" id="login_form" runat="server"> -->
                <form action="" method="post">
	           		<fieldset class="register-input-container">
	           		
	           			<div class="register-input-item">
	           				<input type="email" name="username_login" class="user-name register-user-input" placeholder="Username" >
	           				<div id="login_name_error" class="val_error"></div>
	           			</div>
	           			
	           			<div class="register-input-item">
	           				<input type="password" name="password_login" class="user-password register-user-input" placeholder="Choose Password">
	           				<div id="login_password_error" class="val_error"></div>
	           			</div>
        			</fieldset>
	           		<fieldset class="login-button-container">
	           			<button class="login-button">Login</button>
	           		</fieldset>
	           	</form>
	           	<div class="register-link-container">
	           		<div class="register-login-link">
	           			<p class="message"><span class="register-info-link">Don't have an account?</span> 
	           			<a href="#" class="register-link">Register here!</a></p>
	           		</div>
	           	</div>
           </div>   
           <div class="register-box form2">
	           	<div>
	           		<p class="register-title">Sign Up with Us</p>
	           	</div>
	           	<div class="register-third-party">
	           		<p class="register-btn-info">- EASILY USING -</p>
	           		 <div class="social-login">
      					<a href="#">
        					<i class="fa fa-facebook fa-lg"></i>
        					facebook
      					</a>
      					<a href="#">
       						<i class="fa fa-google-plus fa-lg"></i>
        					Google
      					</a>
    				</div>
	           	</div>
	           	<p class="info-text">- OR USING EMAIL -</p>
	           	<form class="register-form" action="registered_user.php" method="post">
	           		<fieldset class="register-input-container">
	           			<div class="register-input-item">
	           				<input type="email" name="username" class="user-email register-user-input" placeholder="Username" required>
	           				<div id="email_error" type="hidden"></div>
	           			</div>
	           			<div class="register-input-item">
	           				<input type="text" name="mobile" class="user-mobile register-user-input" placeholder="Mobile number(for order status update)" onblur="phoneverify()" onfocus="resetvalue()" id="mobile" required>
	           				<div id="errors" type="hidden"></div>
	           			</div>
	           			
	           			<div class="register-input-item">
	           				<input type="password" name="password" class="user-password register-user-input" placeholder="Choose Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required id="password" onfocus="resetvalue()">
	           			</div>
	           			
	           			<div class="register-input-item">
	           				<input type="password" name="password_confirmation" class="user-password register-user-input" placeholder="Confirm Password" id="password_confirm" onblur="passwordverify()" onfocus="resetvalue()">
	           				<div id="password_error" type="hidden"></div>
	           			</div>
	           			
	           		</fieldset>
	           		<fieldset class="register-button-container">
	           			<button class="register-button">REGISTER</button>
	           		</fieldset>
	           	</form>
	           	<div class="register-link-container">
	           		<div class="register-login-link">
	           			<p class="message"><span class="register-info-link">Already have an account?</span>
	           			<a href="#" class="register-link">Login!</a></p>
	           		</div>
	           	</div>
           </div>


                   	
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="javascripts/register.js"></script> -->

<script type="text/javascript">
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
      function passwordverify(){
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
      function resetvalue(){
      	error.innerHTML="";
      	mobile.innerHTML="";
      	mobile.style.border="";
      	error2.innerHTML="";
      	passwrd.style.innerHTML="";
      	
      	password_confirm.style.border="";
      	passwrd.style.border="";

      }
	//  $(function(){
	// $('#login_form').on('submit',function(event){
	// 	event.preventDefault();
	// 	var formData = new FormData(this);
	// 	if($('.user-name').val()!="" && $('.user-password').val()!=""){
			
	// 		$.ajax({
	// 			type: 'POST',
	// 			url: 'login.php',
	// 			data: formData,
	// 			contentType: false,
	// 			cache: false,
	// 			processData: false,
	// 			success: function(data){
	// 				//alert('form was submitted');
	// 				//$('#output').val(data);
	// 				$('#body_log').empty();
	// 				//$('.login-box').empty();
	// 				$('#body_log').append(data);
	// 			},
	// 			error: function(data){
	// 				alert('not submitted');

	// 			},
	// 			async: false

	// 		});
	// 	}
		
	// });
 // });
 
</script>
</body>
</html>
