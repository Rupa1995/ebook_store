<!DOCTYPE html>
<html>
<head>
  <title>Ebook - Book</title>
  <link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height"> 
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/waitMe.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/main.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/register.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body id="body_log">
<div class="container">
  <div class="header-top">
    <div class="upper-header container">
      <div class="logo">
          <a href="../index.php">
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
                        echo '<li><a href="../edit_profile.php">Edit Profile</a></li>';
                        echo '<li><a href="wishlist_item.php">Wishlist</a></li>';
                        echo '<li><a href="cart_item.php">Cart</a></li>';
                        echo '<li><a href="../logout.php" class="login_user">Logout</a></li>';
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
    </div><hr>
  <div class="clearfix"></div>
 </div>
 <div class="wrapper my-profile">
 	<div class="card my-profile_wrapper">
 		<div class="my-profile_left">
 			<div class="profile-nav">
 				<div class="profile-nav_detail">
 					<div class="account-profile-img"></div>
 					<div class="account-profile-name"><b><i>RUPA RANI</i></b></div>
 					<div class="account-profile-phone"><b><i>7031509154</i></b></div>
 				</div>
 				<div class="profile-nav_list">
 					<ul class="list-unstyled">
 						<a href="#" class="profile-item-list">
 							<li class="item-text fa fa-map-marker"><b><i>My Addresses</i></b></li>
 						</a>
 						<a href="orderlist.php" class="profile-item-list">
 							<li class="item-text fa fa-archive"><b><i>My Orders</i></b></li>
 						</a>
 					</ul>
 				</div>
 			</div>
 		</div>
 		<div class="my-profile_right">
 			<div class="my-carts">
 				<div class="my-cart">
 					<div class="my-cart-box">
 						<div class="my-cart-box-header">
 							<div class="my-cart-box-header-date fa fa-clock-o">Placed Mon, 14 May, 9:27 PM</div>
 							<a href="" class="btn btn-inverted report-issue">Report an issue</a>
 							<div class="clearfix"></div>
 						</div>
 						<div class="my-order">
 							<div class="my-order-timeline">
 								<div class="timeline">
 									<div class="timeline-box">Delivered</div>
 								</div>
 							</div>
 							<div class="my-order-header">
 								<div class="my-order-store">
 									<span class="my-order-store-details">eBooks sTore, Kolkata</span>
 									<span class="my-order-store-details dot">&bull;</span>
 									<span class="my-order-store-details">Rs. 532</span>
 								</div>
 								<div class="order-detail">
 									<span class="my-order-store-details dot">Order ID: 089078HSTG735
 									</span>
 									<span class="my-order-store-details dot">&bull;</span>
 									<span class="my-order-store-details dot">2 items</span>
 								</div>
 							</div>
 							<div class="my-order-list">
 								<div class="my-order-list-item">
 									<a href="orderlist.php" class="order-list">
 										<span class="order-list-item">View 2 items ordered <i class="fa fa-angle-right"></i></span>
 									</a>
 								</div>
 							</div>
 							<div class="clearfix"></div>
 						</div>
 						<div class="cart-box-details panel-group">
 							<div class="cart-view-more panel panel-default">
 								<div class="panel-heading">
 									<h4 class="panel-title">
 									<a data-toggle="collapse" href="#collapsel1">View address and billing details <i class="fa fa-angle-down"></i></a>
 									</h4>
 								</div>
 								<div class="panel-collapse collapse" id="collapsel1">
 									<ul class="list-group">
 										<li class="list-group-item">
 											<h4>Delivery Address:</h4>
 											<p><b>AJ-143, sector 2, saltlake, kolkata - 700091</b></p>
 										</li>
 										<li class="list-group-item">
 											<h4>Payment:</h4>
	 											<p><b><span class="pay">Subtotal:</span><span class="pay-amt">Rs.432</span></b></p>
	 											<p><b><span class="pay">Estimated Tax:</span><span class="pay-amt">Rs. 20</span></b></p>
	 											<p><b><span class="pay">Delivery:</span><span class="pay-amt" style="color: #43e684;">FREE</span></b></p>
	 											<p><b><span class="pay">Amount Payable:</span><span class="pay-amt">Rs. 452</span></b></p>
 										</li>
 									</ul>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
</div>
</body>
</html>