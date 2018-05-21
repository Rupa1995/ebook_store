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
<div class="container">
    <img src="../images/blog-img.jpg"style="margin-left:14%;">
    <div class="container blogs">
      <blockquote>“You should never read just for “enjoyment.” Read to make yourself smarter! Less judgmental. More apt to understand your friends’ insane behavior, or better yet, your own. Pick “hard books.” Ones you have to concentrate on while reading. And for god’s sake, don’t let me ever hear you say, “I can’t read fiction. I only have time for the truth.” Fiction is the truth, fool! Ever hear of “literature”? That means fiction, too, stupid.” — John Waters</blockquote>
      <blockquote>A book is a gift you can open again and again.</blockquote>
      <blockquote>“We don’t need a list of rights and wrongs, tables of dos and don’ts: we need books, time, and silence. Thou shalt not is soon forgotten, but Once upon a time lasts forever.” — Philip Pullman</blockquote>
      <blockquote>“I think we ought to read only the kind of books that wound or stab us. If the book we’re reading doesn’t wake us up with a blow to the head, what are we reading for? So that it will make us happy, as you write? Good Lord, we would be happy precisely if we had no books, and the kind of books that make us happy are the kind we could write ourselves if we had to. But we need books that affect us like a disaster, that grieve us deeply, like the death of someone we loved more than ourselves, like being banished into forests far from everyone, like a suicide. A book must be the axe for the frozen sea within us. That is my belief.” — Franz Kafka</blockquote>
      
</div>
</div>
</div>
<footer>
    <div class="container">
    
      <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6 legals">
             <p><a href="#home">Terms & Conditions</a> |
             <a href="#home">Legals</a>
             </p>     
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6 credit">
              <p>Developed & Designed by <a href="#home"><em>Rupa Rani</em></a> exclusively for <a href="#home">
                <em>Innoraft</em></a></p>
          </div>
      </div>

    </div>
</footer>
</body>
</html>