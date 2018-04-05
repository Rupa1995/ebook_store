<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>result</title>
  <link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="stylesheets/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                <div class="pull-right menu">
                    <div class="right-nav">
                        <a href="#"><i class="fa fa-heart-o" id="icon"></i></a> 
                        <a href="#"><i class="fa fa-shopping-bag" id="icon"></i></a> 
                        <a href="register.php"><i class="fa fa-user" id="icon"></i></a> 
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
         </div>
    </div>
    <div class="container-fluid register-container">
          <div class="login-box form1">
              <div>
                <p class="register-title">User Profile</p>
              </div>
              
                <fieldset class="register-input-container">
                
                  <div class="item">
                        <b>Username: </b>
                          <?php 
                          echo $_POST['username']."<br>";
                          ?>
                  </div>
                  
                  <div class="item">
                    <b>Contact: </b>
                      <?php
                        echo $_POST['mobile']."<br>";
                      ?>
                  </div>
              </fieldset>
              </div>
            </div>
</body>
</html>
<?php
  include "dbconnect.php";
  $_SESSION['user'] = $_POST['username'];
?>