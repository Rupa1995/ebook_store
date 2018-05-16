<?php 
   include 'includes/db.php';
   session_start();
   if(isset($_GET['val]']))
   $val = $_GET['val'];
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusername = mysqli_real_escape_string($conn,$_POST['username_login']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password_login']); 
      $mypassword = md5($mypassword);

      $sql = "
            SELECT
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
         echo $error;
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
     <!--  <form class="search-form" action="#" method="get">
          <i class="fa fa-search"></i>
          <input type="text" name="s" value placeholder="Search by book title..">
          <input type="hidden" name="post_type" value="product">
      </form> -->
      <div class="logo">
          <a href="index.html">
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
<!-- 	<div class="register-third-party">
		<p class="register-btn-info">- EASILY USING -</p>
		<div class="social-login">
    	<a href="#"><i class="fa fa-facebook fa-lg"></i>facebook</a>
    	<a href="#"><i class="fa fa-google-plus fa-lg"></i>Google</a>
    </div>
	</div>
	<p class="info-text">- OR USING EMAIL -</p> -->
  <form action="" method="post">
		<fieldset class="register-input-container">
			<div class="register-input-item">
				<input type="email" name="username_login" class="user-name register-user-input" placeholder="User Email" >
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
			<a href="#" class="register-link" id="reg_new">Register here!</a></p>
		</div>
	</div>
  </div>   
<div class="register-box form2">
	<div><p class="register-title">Sign Up with Us</p></div>
	<!-- <div class="register-third-party">
		<p class="register-btn-info">- EASILY USING -</p>
		 <div class="social-login">
	     <a href="#"><i class="fa fa-facebook fa-lg"></i>facebook</a>
	     <a href="#"><i class="fa fa-google-plus fa-lg"></i>Google</a>
    </div>
	</div>
	<p class="info-text">- OR USING EMAIL -</p> -->
	<form class="register-form" action="registered_user.php" method="post">
		<fieldset class="register-input-container">
			<div class="register-input-item">
				<input type="email" name="username" class="user-email register-user-input" placeholder="User Email" required>
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

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="javascripts/register.js"></script>
<script src="javascripts/register_new.js"></script>
<script type="text/javascript">
  var val = <?php echo $val; ?>;
  if(val == 1)
  {
    $('#reg_new').trigger('click');
  }
  
</script>
</body>
</html>
