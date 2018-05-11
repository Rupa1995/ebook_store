<?php
	session_start();
	include 'includes/db.php';
    include 'includes/function.php';
	$sql = "SELECT
                book_id,
                book_title,
                book_published_date,
                book_mrp,
                book_quantity,
                author_name,
                cat_name,
                pub_name
            FROM
                ".BOOK." AS B
            LEFT JOIN ".BOOK_CAT." AS C ON B.book_cat_id = C.cat_id 
            LEFT JOIN ".AUTHOR." AS A ON B.book_authid = A.author_id 
            LEFT JOIN ".PUBLISHER." AS P ON B.book_pubid = P.pub_id";


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
echo '<div class="admin-box" id="">';
echo '<div class="panel panel-back noti-box">';
echo '<div class="image-logo"><img src="../images/portfolio-01.jpg">';//yaha image daalna

echo '<p class="image-title">'.$_SESSION['BookArr'][$i]['book_title'].'</p>'; //text mei aut design krna ki pic ke upar aaye
// echo '</div>';
echo '</div>';
echo '<button class="btn-cart"><i class="fa fa-cart-plus"></i></button>';
echo '<button class="btn-wish"><i class="fa fa-heart-o"></i></button>';
echo '</div>';
echo '</div>';
//box ke nice ek aur box rahega chota sa jismei 2 button hoga buy or Add to chart
	}	
?>
      </div>
    </div>
  </div>
 
<script type='text/javascript' src="../js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../js/bootstrap.min.js"></script>
<script type='text/javascript' src="../js/bootstrap-select.min.js"></script>
<script type='text/javascript' src="../js/waitMe.js"></script>
<script type='text/javascript' src="../javascripts/key_validation.js"></script>
<script type='text/javascript' src="../javascripts/comman.js"></script>
</body>
</html>