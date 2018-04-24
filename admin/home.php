<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Ebook - Admin </title>
  <link rel="icon" type="images/png" href="/..images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../stylesheets/admin.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
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
 		<div class="dropdown">
 			<i class = "fa fa-user dropdown-toggle" style = "font-size : 40px" data-toggle="dropdown"></i>
   				<ul class="dropdown-menu">
   				 <?php 
              	if(isset($_SESSION['login_user']))
              	{
                	echo '<li><a href="#">Edit Profile</a></li>';
                	echo '<li><a href="../logout.php" class="login_user">Logout</i></a></li>';
                } 
                else
                { 
                  echo '<li><a href="../register.php?action=logout" class="register_user">Login/SignUp</a></li>';
                 }
               ?>
				</ul>
		</div> 
    </div>
  </div>
</div>
        <div class="clearfix"></div>
  </div>
	    
</header>
<div class="container dash">
	<h2>Welcome Admin</h2>
</div>
	<div class="content container">
		<div class="col-md-12 container">
		<div class="link_box col-md-4">
			<a href="book_category.php">
				<div class="box_img">
						<img src="../images/categ6.png" height="100px" width="150px">
				</div>
				<div class="box_text">Books Categories</div>
			</a>
		</div>
		<div class="link_box col-md-4">
			<a href="book.php">
				<div class="box_img">
					<img src="../images/categ.gif" height="100px" width="150px">
				</div>
				<div class="box_text">Book List</div>
			</a>
		</div>
		<div class="link_box col-md-4">
			<a href="admin/user.php">
				<div class="box_img">
					<img src="../images/categ4.gif" height="100px" width="150px">
				</div>
				<div class="box_text">Users</div>
			</a>
		</div>
	</div>
	<div class="col-md-12 container">
		
		<div class="link_box col-md-4">
			<a href="">
				<div class="box_img">
					<img src="../images/categ7.gif" height="100px" width="150px">
				</div>
				<div class="box_text">Records</div>
			</a>
		</div>
		<div class="link_box col-md-4">
			<a href="">
				<div class="box_img">
					<img src="../images/categ5.gif" height="100px" width="150px">
				</div>
				<div class="box_text">Orders</div>
			</a>
		</div>
		<div class="link_box col-md-4">
			<a href="">
				<div class="box_img">
					<img src="../images/categ8.gif" height="100px" width="150px">
				</div>
				<div class="box_text">Queries</div>
			</a>
		</div>
	</div>
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
</body>
</html>
