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
  <div><img src="../images/about.jpeg"style="padding-bottom: 50px; width: 100%; max-height: 400px;"></div>
<div class="container">
    <div class="col-md-4">
      <h4>Browse books online //</h4>
      <p>We have a very good collection of all your favourite books. Grab the books that you love and dive deep in the ocean of imagination !!!</p>
    </div>
    <div class="col-md-4">
      <h4>Buy your favourite books //</h4>
      <p>If you find a book you like, you can click on the "Add to wishlist" icon or if you want to buy the book just add them to your cart and go forward to checkout.</p>
    </div>
    <div class="col-md-4">
      <h4>Learn more fast //</h4>
      <p>We've created reference for every book so you can quickly find all kinds of relevant information: story line, price, author .</p>
    </div>
</div>
</div>
<footer>
    <div class="container">
    
      <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6 legals">
             <p><a href="">Terms & Conditions</a> |
             <a href="">Legals</a>
             </p>     
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6 credit">
              <p>Developed & Designed by <a href=""><em>Rupa Rani</em></a> exclusively for <a href="https://technoindiauniversity.ac.in/" target="_blank">
                <em>Techno India University</em></a></p>
          </div>
      </div>

    </div>
</footer>
</body>
</html>