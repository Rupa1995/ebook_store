<?php include '../login.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Ebook Store - Book Category</title>
  <link rel="icon" type="images/png" href="../images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="stylesheets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../stylesheets/admin.css">    
</head>

<body>

 <header id="home" style="border-bottom: 1px solid #f4efef;">      
	
	      <div class="header">
	            <div class="upper container">
	              <div class="logo">
	                <h1>Books</h1><br>
	                <span>ebook store</span>
	              </div>  
	              <div class="pull-right menu">
	                <div class="right-nav">
	                  <ul class="log">
	                    <li>
	                      <?php 
                              if(isset($_SESSION['login_user'])){
                                echo '<a href="../logout.php" class="login_user"><i class = "fa fa-user" style = "font-size : 40px"></i></a>';
                                } 
                                else{ 
                                  echo '<a href="../register.php?action=logout" class="register_user">Login/SignUp</a>';
                                  }
                               ?>
	                    </li>
	                </ul>
	                </div>
	              </div>
	            </div>
	            <div class="clearfix"></div>
	      </div>
	    
</header>
<div class="container dash">
	<h2>Welcome Admin</h2>
</div>
<div id="slidetab">
	<div style="position: relative;">
		<div class="zoom_img" style="position: absolute; top: 0; left: 0;">
			<a href="home.php" data-placement="right" data-toggle ="tooltip" title data-original-title ="Dashboard">
				<img src="../images/dashboard.png">
			</a>
		</div>
		<div class="zoom_img" style="position: absolute; top: 0; left: 0; margin-top: 86px;">
			<a href="book_category.php" data-placement="right" data-toggle ="tooltip" title data-original-title ="Dashboard">
				<img src="../images/category.png">
			</a>
		</div>
		<div class="zoom_img" style="position: absolute; top: 0; left: 0; margin-top: 190px;">
			<a href="book.php" data-placement="right" data-toggle ="tooltip" title data-original-title ="Dashboard">
				<img src="../images/bookicon.png">
			</a>
		</div>
		<div class="zoom_img" style="position: absolute; top: 0; left: 0; margin-top: 285px;">
			<a href="order.php" data-placement="right" data-toggle ="tooltip" title data-original-title ="Dashboard">
				<img src="../images/box.png">
			</a>
		</div>
		<div class="zoom_img" style="position: absolute; top: 0; left: 0;margin-top: 370px;">
			<a href="users.php" data-placement="right" data-toggle ="tooltip" title data-original-title ="Dashboard">
				<img src="../images/users.png">
			</a>
		</div>
	</div>
</div>
<div class="content container">
	<div class="category">
		<a href="">
			<img src="../images/categ6.png">
			<div class="box_text"><h2>Books Categories</h2></div>
		</a>
	</div>
	<hr>
	<div class="clearfix"></div>
	<div>
		<form id="add_category">
			<input type="text" name="category">
			<button><b>+</b> Add Category</button>
		</form>
	</div>
</div>

<script src="javascripts/js/jquery-3.3.1.min.js"></script>
<script src="javascripts/js/bootstrap.min.js"></script>

</body>
</html>
