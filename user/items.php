<!DOCTYPE html>
<html>
<head>
  <title>Ebook - Edit Profile</title>
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
          <a href="../index.php">
            <h1>Books</h1>
            <span>ebook store</span>
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
                        echo '<li><a href="#">Wishlist</a></li>';
                        echo '<li><a href="#">Cart</a></li>';
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
    </div>
  <div class="clearfix"></div><hr>
  </div>
</div>
<div class="item container">
  <div>
    <p class="bag"><em>My Shopping Bag</em></p>
    <p class="total-price"><em>Total: Rs 681</em></p>
    <div class="clearfix"></div>
     <div class="book-detail">
         <img src="../images/book.png" class="book-img">
       <div class="book-details">
         <h2 id="book-name">book name</h2>
         <p id="book-price">Rs. 649</p>
         <p id="seller">seller</p>
         <p id="book-price-prev"><em>(discount) </em><strike>Rs. 649</strike></p>
         <p id="drp">Qty: 
          <select>
            <option>--</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
          </select>
         </p>
         <p id="book-price-prev" style="margin-left: 0;">Only 1 unit in stock !</p>
       </div>
       <hr>
       <a href="#" id="remove-link">REMOVE</a>
       <a href="#" id="move-to-wishlist">MOVE TO WISHLIST</a>
     </div>

 </div>
 <div class="book-receipt container">
   <!-- <h4><strong>OPTIONS</strong></h4>
   <strong>Coupons</strong>
   <button id="coupons">Apply Coupons</button>
   <hr> -->
   <strong>Price Details : </strong><br>
   <div style="float: left;">
     <p>Bag Total</p>
     <p>Bag Discount</p>
     <p>Estimated Tax</p>
     <!-- <p>Coupon Discount</p> -->
     <p>Delivery</p>
     <hr>
     <strong>Order Total</strong>
   </div>
   <div style="float: right;">
     <p>Rs. 568</p>
     <p>Rs. 58</p>
     <p>Rs. 20</p>
     <!-- <p><a href="#">Apply Coupon</a></p> -->
     <p style="color: lightgreen;">FREE</p>
     <hr>
      <strong>Rs. 530</strong> 
   </div>
    <button id="place-order">PLACE ORDER</button>  
 </div>  
</div>
<div class="container add-more">
  <i class="fa fa-bookmark"></i>
  <a href="#">Add more from wishlist</a>
</div>
</body>
</html>
