<?php
  include 'includes/db.php';
  session_start();
  $u_name = $_POST['username'];
  $u_mobile = $_POST['mobile'];
  $u_password = $_POST['password'];
  $u_password = md5($u_password);
  $check_exist = "SELECT
                    user_name
                  FROM
                  ".LOGIN_TABLE."
                  WHERE
                  user_name = '$u_name'";
  $result_exist = mysqli_query($conn,$check_exist);
  $count = mysqli_num_rows($result_exist);              
  if($count>0)
  {
    $result = 0;
  }
  else
  {
    $sql_insert = "INSERT INTO 
                ".LOGIN_TABLE." 
                SET 
                user_name = '$u_name', 
                user_password = '$u_password', 
                user_isactive = '1', 
                user_admin_flag = '0', 
                user_mobile = '$u_mobile'";
    $result = mysqli_query($conn,$sql_insert);              
  }
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ebook Store - SignUp</title>
  <link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
   <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="stylesheets/register.css">
  
</head>
<body>
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
            </div>
            <div class="clearfix"></div>
         </div>
    </div>
   
<div class="modal fade welcome-modal" id="newuser_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
     <div class="modal-dialog modal-sm" role="document" style="width: 30%;">
      <div class="modal-content">
         <div class="modal-body text-center" >
          <h2 class="welcome">Welcome </h2>
          <p class="message-welcome">to Ebook Store, a <b>TIU</b> product</p>
            <p>User Name :  <?php echo $u_name; ?></p>
            <p>Contact : <?php echo $u_mobile; ?></p>
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
           <p>User Name : <span class="red"><?php echo $u_name; ?></span> already exits, Please try with different User Name or Login with Same</p>
           <button type="button" aria-label="Close" data-toggle="tooltip" data-original-title="" class="btn btn-lg btn-blue" id ="login_again" >Login wih Same</button> 
           <button type="button" aria-label="Close" data-toggle="tooltip" data-original-title="" class="btn btn-lg btn-grey" id ="register_new" >Register New</button>        
        </div>
      </div>
    </div>
  </div>
  <script src="javascripts/js/jquery-3.3.1.min.js"></script>
  <script src="javascripts/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    var new_user = <?php echo $result; ?>;
    if(new_user == 1)
    {
      $("#newuser_pop").modal('show');   
    }
    else
    {
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
        header("location: index.php");
      }
    });
  </script>


</body>
</html> 
