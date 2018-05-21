<?php
session_start();
include 'includes/db.php';
include 'includes/function.php';
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
$item_html = '';
$mail = new PHPMailer(); 
$item_count = count($items);
for($i=0;$i<count($items);$i++)
{
	$sql_item = "INSERT INTO item_table
				 SET
				 item_book_id = '".$items[$i]['sku']."',
				 item_name = '".$items[$i]['name']."',
				 item_price = '".$items[$i]['price']."',
				 item_order_id = '".$last_id."'";
    $result = mysqli_query($conn, $sql_item);

    $sql_img = "SELECT 
                  book_image
                FROM 
                book_table 
                WHERE book_id = '".$items[$i]['sku']."'";
    $result = mysqli_query($conn, $sql_img); 
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $book_image = $row['book_image'];

    $mail->AddEmbeddedImage($book_image, $book_image, $book_image);
    $item_html.= '<div style="border: 2px solid #e3e0e0; float: left; width: 100%;">';
    $item_html.= '<img src="cid:'.$book_image.'" style="float: left; width: 25%; max-height: 200px; margin: 0px; padding: 0px; border: 1px solid beige;">';
    $item_html.= '<h3 style="margin-left: 50%; ">'.$items[$i]['name'].'</h3>';
    $item_html.= '<p style="margin-left: 50%; font-size: 15px; color: black;margin-bottom: 0;">Rs. '.$items[$i]['price'].'</p>';
    $item_html.= '</div>';
 

    $d_sql = "DELETE 
              FROM 
              ".CART." 
              WHERE 
              bc_book_id  = '".$items[$i]['sku']."' AND bc_user_id = '".$order['by']."'";

    $result_del = mysqli_query($conn, $d_sql);           
}

$mailContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>BOOK - User Registration</title>
        </head>
        <body>
          <div style="width:100%;background:#F2F2F2;font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#404D5E;overflow:hidden;line-height:18px;">
          <div style="width:570px;margin:15px 15px;background:#fff;padding:15px;border:solid 1px #EDEDED;overflow:hidden;">
          <div style="overflow:hidden;border-bottom:solid 1px #E0E0E0;padding-bottom:15px;margin-bottom:15px;">
          <div style="width:50%;float:left;overflow:hidden;">
            <img src="https://i.pinimg.com/originals/c4/fc/3d/c4fc3d8aaf399bdfcd7eb9c8deb319dd.jpg" width="50" height="50" />
          </div>
          <div style="width:50%;float:left;overflow:hidden;"></div>
          </div>
          <div style="overflow:hidden;">                
            <p style="font-size:14px;">Dear Reader,</p>
            <p style="font-size:14px;">
            We are pleased to inform you that '.$item_count.' item from your order '.$order['id'].' has been shipped!</p>
            <div style="width: 100%;">
              <h3><b>Delivery Address : </b></h3>
              <p style="font-size:14px;">'.$shipping['recipient_name'].'</p>
              <p style="font-size:14px;">'.$shipping['line1'].', '.$shipping['line2'].',</p>
              <p style="font-size:14px;">'.$shipping['city'].',</p>
              <p style="font-size:14px;">'.$shipping['state'].' - '.$shipping['postal_code'].'</p>
            </div>
            <hr>
            '.$item_html.'
            <p style="font-size:14px;"><strong>Total :</strong> '.$order['amt'].'(inclusive of tax)</p>
            <br>
            <p style="font-size:14px;margin:0;">Thank You</p>
            <br>
            <br>
            <p style="color:#828282;margin:0;"><i><br>This notification was automatically generated. Please do not reply to this mail.</i></p>
        </div>
      </div>
    </div>
  </div>              
</body>
</html>';

    $sql_mail = "SELECT 
                  user_name
                FROM 
                user_table 
                WHERE 
                user_id = '".$order['by']."'";
    $result = mysqli_query($conn, $sql_mail); 
    $row2 = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    $emailId = $row2['user_name'];

    $toaddr = explode("," , $emailId);
    $error;
     
    $mail->IsSMTP(); 
    $mail->SMTPDebug = 0;  
    $mail->SMTPAuth = true;  
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = GUSER;                 
    $mail->Password = GPWD; 
    $mail->IsHTML(true);         
    $mail->SetFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
    $mail->Subject = 'Order Confirmation';
    
    $mail->Body = html_entity_decode($mailContent);
    
    foreach($toaddr as $ad){
      $mail->AddAddress(trim($ad));
    }
    //$mail->AddAddress($to);
    if(!$mail->Send()) {
      //echo $mail->ErrorInfo;
    } else {
      //echo "Mail Sent";
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
                        echo '<li><a href="../edit_profile.php?uid='.$_SESSION['userID'].'">Edit Profile</a></li>';
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
