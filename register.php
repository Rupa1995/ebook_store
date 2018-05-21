<?php 
   include 'includes/db.php';
   session_start();
   $error = '';
   if(isset($_GET['val]']))
   {
    $val = $_GET['val']; 
   }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusername = mysqli_real_escape_string($conn,$_POST['username_login']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password_login']); 
      $mypassword = md5($mypassword);

      $sql = "SELECT
             user_id AS u_id, 
             user_admin_flag AS admin_flag,
             user_name AS uname,
             first_tym_flag
            FROM 
              ".LOGIN_TABLE." 
            WHERE 
              user_name = '$myusername' AND 
              user_password = '$mypassword' AND
              user_isactive = '1'";
      
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $admin_flag = $row['admin_flag'];
      $first_tym_flag = $row['first_tym_flag'];
      $uname = $row['uname'];

      $count = mysqli_num_rows($result);
      
      if($count == 1) 
      {
         $_SESSION['login_user'] = $uname;
         $_SESSION['first_tym_flag'] = $first_tym_flag;
         $_SESSION['userID'] = $row['u_id'];
         if($admin_flag == '1')
         {
            header("location: ./admin/home.php");
         }
         else
         {
            header("location: index.php");
         }
      }
      else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?> 

<!DOCTYPE html>
<html>
<head>
	<title>Ebook Store - Login/SignUp</title>
	<link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/register.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/main.css"> 
</head>
<body id="body_log">
<div class="container">
  <div class="header-top">
    <div class="upper-header container"> 
      <div class="logo">
          <a href="index.php">
          	<h1>Books</h1>
          	<span>eBook sTore</span>
          </a>
      </div>  
      <div class="pull-right menu">
        <div class="right-nav" style="margin-right:77%;">
          <div class="dropdown">
            <i class = "fa fa-user dropdown-toggle" style = "font-size : 40px" data-toggle="dropdown"></i>
                <ul class="dropdown-menu">
                 <?php 
                      if(isset($_SESSION['login_user']))
                      {
                        echo '<li><a href="edit_profile.php">Edit Profile</a></li>';
                        echo '<li><a href="#">Wishlist</a></li>';
                        echo '<li><a href="#">Cart</a></li>';
                        echo '<li><a href="logout.php" class="login_user">Logout</a></li>';
                      } 
                      else
                      { 
                        echo '<li><a href="register.php?action=logout" class="register_user">Login/SignUp</a></li>';
                       }
                     ?>
              </ul>
        </div> 
        </div>
      </div>
    </div>
  <div class="clearfix"></div>
  </div>
</div>
   
<div class="container-fluid register-container">
  <div class="login-box form1">
	<div><p class="register-title">Log In</p></div>
  <form action="" method="post">
		<fieldset class="register-input-container">
			<div class="register-input-item">
				<input type="email" name="username_login" class="user-name register-user-input" placeholder="User Email" required >
				<div id="login_name_error" class="val_error"></div>
			</div>
			<div class="register-input-item">
				<input type="password" name="password_login" class="user-password register-user-input" placeholder="Choose Password" required>
				<div id="login_password_error" style="color: #FF1F1F;">
        <span><?php echo $error; ?></span>    
        </div>
			</div>
    </fieldset>
		<fieldset class="login-button-container">
			<button class="login-button">Login</button>
		</fieldset>
	</form>
	<div class="register-link-container">
		<div class="register-login-link">
			<p class="message"><span class="register-info-link">Don't have an account?</span> 
			<a href="#" class="register-link" id="reg_new">Register here!</a></p>
		</div>
	</div>
  </div>  

<div class="register-box form2">
	<div><p class="register-title">Sign Up with Us</p></div>
		<fieldset class="register-input-container">
      <div class="register-input-item">
        <input type="text" name="fname" id="fname" class="user-email register-user-input" placeholder="First Name">
        <div id="fname_error" class="val_error"></div>
      </div>
      <div class="register-input-item">
        <input type="text" name="lname" id="lname" class="user-email register-user-input" placeholder="Last Name">
        <div id="lname_error" class="val_error"></div>
      </div>
			<div class="register-input-item">
				<input type="email" name="username" id="username" class="user-email register-user-input" placeholder="User Email">
				<div id="email_error" class="val_error"></div>
			</div>
			<div class="register-input-item">
				<input type="password" name="password" id="pwd" class="user-password register-user-input" placeholder="Enter Password" id="password">
			</div>
			<div class="register-input-item">
				<input type="password" name="password_confirmation" id="cnfpwd" class="user-password register-user-input" placeholder="Confirm Password" id="password_confirm">
				<div id="password_error" class="val_error"></div>
			</div>
		</fieldset>
		<fieldset class="register-button-container">
			<button class="register-button" id="register">REGISTER</button>
		</fieldset>
	<div class="register-link-container">
		<div class="register-login-link">
			<p class="message"><span class="register-info-link">Already have an account?</span>
			<a href="#" class="register-link">Login!</a></p>
		</div>
	</div>
</div>
</div>

<div class="modal fade welcome-modal" id="newuser_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
     <div class="modal-dialog modal-sm" role="document" style="width: 30%;">
      <div class="modal-content">
         <div class="modal-body text-center" >
          <h2 class="welcome">Welcome </h2>
          <p class="message-welcome">to Ebook Store, a <b>TIU</b> product</p>
            <p id="Cuname"></p>
            <p id="Cpass"></p>
           <button type="button" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-original-title="" class="btn btn-lg btn-yellow" id ="welcome_ok" >Continue</button>        
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade welcome-modal" id="erro_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
     <div class="modal-dialog modal-sm" role="document" style="width: 36%;">
      <div class="modal-content">
         <div class="modal-body text-center" >
          <h2 class="welcome">Welcome </h2>
          <p class="message-welcome">to Ebook Store, a <b>TIU</b> product</p>
           <p>User Name : <span class="red" id="err_username"></span> already exits, Please try with different User Name or Login with Same</p>
           <button type="button" aria-label="Close" data-toggle="tooltip" data-original-title="" class="btn btn-lg btn-blue" id ="login_again" >Login wih Same</button> 
           <button type="button" aria-label="Close" data-toggle="tooltip" data-original-title="" class="btn btn-lg btn-grey" id ="register_new" >Register New</button>        
        </div>
      </div>
    </div>
  </div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('.message a').click(function() {
    $('.form1').animate({height: "toggle", opacity: "toggle"}, "slow");
     $('.form2').animate({height: "toggle", opacity: "toggle"}, "slow");
  }); 

  $("body").on('click','#register',function(){
    $('.val_error').text('').hide();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var uname = $("#username").val();
    var pwd = $("#pwd").val();
    var cnfpwd = $("#cnfpwd").val();
    var valid = 1;
    if(fname.trim()==''||fname.trim()==null)
    {
      $("#fname_error").html('<span>Please Enter First Name.</span>').show();
      valid = 0;
    }

    if(lname.trim()==''||lname.trim()==null)
    {
      $("#lname_error").html('<span>Please Enter Last Name.</span>').show();
      valid = 0;
    }

    if(uname.trim()==''||uname.trim()==null)
    {
      $("#email_error").html('<span>Please Enter User Email.</span>').show();
      valid = 0;
    }

    if(pwd.trim()==''||pwd.trim()==null)
    {
      $("#password_error").html('<span>Please Enter Password.</span>').show();
      valid = 0;
    }

    if(cnfpwd.trim()==''||cnfpwd.trim()==null)
    {
      $("#password_error").html('<span>Please Enter Confirm Password.</span>').show();
      valid = 0;
    }

    if(pwd.trim()!=cnfpwd.trim())
    {
      $("#password_error").html('<span>Password and Confirm Password should be same.</span>').show();
      valid = 0;
    }

    if(valid==1)
    {
      $.ajax({
          url: "registered_user.php",
          type: 'POST',//method type
          dataType:'text',
          cache: false,//do not allow requested page to be cached
          data: {fname:fname,lname:lname,uname:uname,pwd:pwd,cnfpwd:cnfpwd}
        }).done(function(data)
        {
         data = JSON.parse(data);
         var new_user = data.ebook.inserted;

          if(new_user == 1)
          {
            $("#Cuname").text(data.ebook.userName);
            $("#Cpass").text(data.ebook.pass);
            $("#newuser_pop").modal('show');   
          }
          else
          {
            $("#err_username").text(data.ebook.userName);
            $("#erro_pop").modal('show');
          }

          $("#login_again").on("click",function(e)
          {
            window.location = "register.php?action=logout";
          });
          $("#register_new").on("click",function(e)
          {
            window.location = "register.php?val=1";
          });  

          $("#welcome_ok").on("click", function(e){
            if(new_user==1)
            {
             window.location = "index.php";
            }
          });
         
        });
    }
  });

  var val = '<?php echo $val; ?>';
  if(val == 1)
  {
    $('#reg_new').trigger('click');
  }


});
</script>
</body>
</html>
