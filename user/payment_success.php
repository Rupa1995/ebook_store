<?php
session_start();
include 'includes/db.php';

$items = array();
$shipping = array();
$order = array();

$shipping = $_SESSION['paymentArr']['transactions'][0]['item_list']['shipping_address'];
$items = $_SESSION['paymentArr']['transactions'][0]['item_list']['items'];
$order['id'] = $_SESSION['paymentArr']['id'];
$date=date_create($_SESSION['paymentArr']['create_time']);
$order['time'] = date_format($date,"Y-m-d H:i:s");
$order['by'] = $_SESSION['userID'] ;
$order['amt'] = $_SESSION['paymentArr']['transactions'][0]['amount']['total'];

$sql_order = "INSERT INTO order_table 
			  SET 
			  payment_id = '".$order['id']."',
			  order_time = '".$order['time']."',
			  order_by = '".$order['by']."',
			  oder_amt = '".$order['amt']."',
			  order_name = '".$shipping['recipient_name']."'";
$result = mysqli_query($conn, $sql_order);
$last_id = mysqli_insert_id($conn);

$sql_state = "SELECT 
			 id AS state_id, 
			 country_id 
			 FROM states WHERE name LIKE '%".$shipping['state']."%'";
$result = mysqli_query($conn, $sql_state); 
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$state_id = $row['state_id'];
$country_id = $row['country_id'];

$sql_add = "INSERT INTO address
			SET 
			auser_id = 0,	
			aorder_id = '".$last_id."',
			street1 = '".$shipping['line1']."',
			street2 = '".$shipping['line2']."',
			astate_id = '".$state_id."',
			acontry_id 	= '".$country_id."',
			region 	= '".$shipping['country_code']."',
			city = '".$shipping['city']."',
			zip = '".$shipping['postal_code']."'";
			
$result = mysqli_query($conn, $sql_add); 

for($i=0;$i<count($items);$i++)
{
	$sql_item = "INSERT INTO item_table
				 SET
				 item_book_id = '".$items[$i]['sku']."',
				 item_name = '".$items[$i]['name']."',
				 item_price = '".$items[$i]['price']."',
				 item_order_id = '".$last_id."'";

    $result = mysqli_query($conn, $sql_item); 

    $d_sql = "DELETE 
              FROM 
              ".CART." 
              WHERE 
              bc_book_id  = '".$items[$i]['sku']."' AND bc_user_id = '".$order['by']."'";

    $result_del = mysqli_query($conn, $d_sql);           
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Ebook - Transaction</title>
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
    </div>
  <div class="clearfix"></div>
  </div>
</div>
<div id="page-wrapper" class="full-width">
  <div class="right-panel">
    <h3>Transaction Successfull.</h3>
    <br>
    <h4>If you have some issue, Please contact eBook customer services.</h4>
    <h4>Email ID: pustakalaya.ebook@gmail.com</h4>
    <button class="btn btn-sm blue-btn-go" id="failureBtn" type="button" title ="" data-placement="top" data-toggle="tooltip" data-original-title="">Continue</button>
  </div>
</div>
<script type='text/javascript' src="../js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../js/bootstrap.min.js"></script>
<script type='text/javascript' src="../js/bootstrap-select.min.js"></script>
<script type='text/javascript' src="../js/waitMe.js"></script>
<script type='text/javascript' src="../javascripts/key_validation.js"></script>
<script type='text/javascript' src="../javascripts/comman.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('body').on('click','#failureBtn',function(){
   window.location.href = '../index.php';
});

});
</script> 
</body>
</html> 
