<?php
	session_start();
  $current_user = $_SESSION['userID'];
  if(!isset($_SESSION['login_user']))
  {
    header("location: ../register.php?action=logout");
  }
	include 'includes/db.php';
  
  $sql = "SELECT
            book_id,
            book_title,
            book_published_date,
            book_mrp,
            book_quantity,
            author_name,
            book_image,
            cat_name,
            pub_name,
            if(book_wish_id  is null ,'' ,book_wish_id )AS wish_id,
          if(book_cart_id  is null ,'' ,book_cart_id )AS cart_id
        FROM
            book_table AS B
        LEFT JOIN book_cat AS C
        ON
            B.book_cat_id = C.cat_id
        LEFT JOIN author_table AS A
        ON
            B.book_authid = A.author_id
        LEFT JOIN pub_info AS P
        ON
            B.book_pubid = P.pub_id
        LEFT JOIN book_wish AS W
        ON
            B.book_id = W.bw_book_id AND W.bw_user_id = '$current_user'
        LEFT JOIN book_cart AS CA
        ON
            B.book_id = CA.bc_book_id AND CA.bc_user_id = '$current_user'";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result); 
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $_SESSION['BookArr'] = $result;

?>
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
  <div class="clearfix"></div>
  </div>
</div>
<div id="page-wrapper" class="full-width">
    <div class="right-panel">
      <div class="title">Books</div>
      	<div class="content-main">
<?php 
for ($i = 0; $i < count($_SESSION['BookArr']); $i++) 
	{ 
    if($_SESSION['BookArr'][$i]['cart_id']!='')
    {
      $cart_class = "icon-red";
      $cart_title = "Added To Cart";
    }
    else
    {
      $cart_class = ""; 
      $cart_title = "Add To Cart";
    }

    if($_SESSION['BookArr'][$i]['wish_id']!='')
    {
      $wish_class = "icon-red";
      $wish_title = "Added To Wishlist";
    }
    else
    {
      $wish_class = ""; 
      $wish_title = "Add To Wishlist";
    }

    echo '<div class="admin-box" id="">';
    echo '<div class="panel panel-back noti-box">';
    echo '<div class="image-logo"><img src="'.$_SESSION['BookArr'][$i]['book_image'].'">';
    echo '<p class="image-title">'.$_SESSION['BookArr'][$i]['book_title'].'</p>'; 
    echo '</div>';
    echo '<button class="btn-cart" title ="'.$cart_title.'" data-placement="top" data-toggle="tooltip" data-original-title="" id="'.$_SESSION['BookArr'][$i]['book_id'].'"><i class="fa fa-cart-plus '.$cart_class.'"></i></button>';
    echo '<button class="btn-wish" title ="'.$wish_title.'" data-placement="top" data-toggle="tooltip" data-original-title="" id="'.$_SESSION['BookArr'][$i]['book_id'].'"><i class="fa fa-heart '.$wish_class.'"></i></button>';
    echo '</div>';
    echo '</div>';
	}	
?>
      </div>
    </div>
  </div>
<!-- alert modal starts here -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabela" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="alertTitle">Message</h4>
        </div>  
        <div class="modal-body">
          <p id="alertBody"></p>
        </div>
        <input type="hidden" name="alert_value" id="alert_value">
        <div class="modal-footer text-center">
          <button type="button" id = "confirm_ok" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-navyblue" data-placement="top" data-toggle="tooltip" data-original-title ="">OK</button>
        </div>
      </div>
    </div>
  </div>
<script type='text/javascript' src="../js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../js/bootstrap.min.js"></script>
<script type='text/javascript' src="../js/bootstrap-select.min.js"></script>
<script type='text/javascript' src="../js/waitMe.js"></script>
<script type='text/javascript' src="../javascripts/key_validation.js"></script>
<script type='text/javascript' src="../javascripts/comman.js"></script>
<script type='text/javascript' src="../javascripts/buy_book.js"></script>
</body>
</html>