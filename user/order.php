<?php
session_start();
include 'includes/db.php';
?>
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
    </div><hr>
  <div class="clearfix"></div>
 </div>
 <div class="wrapper">
  <p style="font-size: 25px; color: black;"><em style="border-bottom: 1px dotted black;">My Order</em></p>
 	<div class="card">
 		<div class="my-profile_right">
 			<div class="my-carts">
 				<div class="my-cart">
 					<div class="my-cart-box" id="orderheader">
 						
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
</div>

<div class="modal fade" id="reportIssueModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelc"  data-backdrop="static">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabelc">Report Issue</h4>
    </div>
    <form class="form-horizontal input"> 
    <div class="modal-body overflow-nohidden">
    <div class="content-main overflow-nohidden">
    <div class="form-group">
      <div class="col-sm-12">
        <label>Order ID <span class="red">*</span></label>
        <input type="hidden" name="hord_id" id="hord_id">
        <input type="text" class="form-control" name="ord_id" id="ord_id" readonly="readonly">
        <span class="red"><p class="error-display eEmailTmpNameErr"></p></span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <label>Email Subject <span class="red">*</span></label>
          <input type="text" class="form-control" name="eEmailTmpSubName" id="eEmailTmpSubName">
          <p style="color:red" class="eEmailTmpSubNameErr error-display" id="eEmailTmpSubNameErr"></p>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <label>Email Description</label><span class="red">*</span>
        <div>
        <textarea class="form-control" name="eEmailTmpDesc" id="eEmailTmpDesc" style="width: 836px; height: 200px" ></textarea>
        <p style="color:red" class="eEmailTmpDescErr error-display" id="eEmailTmpDescErr"></p>
        </div>
      </div>
    </div>
  </div>   
    </div>
    <div class="modal-footer">
      <div class="pull-right">
        <button class="btn btn-sm green-btn" id="sendMail" type="button" data-toggle="tooltip" data-original-title="">Send Mail</button>
        <button class="btn btn-sm btn-grey" data-dismiss="modal" aria-label="Close" type="button" data-toggle="tooltip" data-original-title="">Cancel</button>
        
     </div>
    </div>
     </form>
  </div>
</div>
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

<script type='text/javascript' src="../js/waitMe.js"></script>
<script type='text/javascript' src="../javascripts/key_validation.js"></script>
<script type='text/javascript' src="../javascripts/comman.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
 
  function precisionRound(number, precision) 
  {
    var factor = Math.pow(10, precision);
    return Math.round(number * factor) / factor;
  }

  var current_effect = 'win8';
  run_waitMe(current_effect);// start the loader
  $.ajax({
      url: "book_class.php",
      type: 'POST',//method type
      dataType:'text',
      cache: false,//do not allow requested page to be cached
      data: {ajaxcall : true,function2call: 'getOrder'}
    }).done(function(data)
    {
    data = JSON.parse(data);
    $('body').waitMe('hide');
    var html = '';
    var len = data.ebook.orderDetails.length;
    var orderDetails = data.ebook.orderDetails;
    var item_count = data.ebook.item_count;
    var subtotal = data.ebook.subtotal;
    if(len>0)
    {
      for(var i=0; i<len; i++)
      {
        
        var tax = orderDetails[i]['oder_amt']-subtotal[i];
        tax = precisionRound(tax,2);
        html +='<div class="my-cart-box-header">';
        html +='<div class="my-cart-box-header-date fa fa-clock-o">Placed '+orderDetails[i]['order_time']+'</div>';
        html +='<a href="#" class="btn btn-inverted report-issue" payment_id="'+orderDetails[i]['payment_id']+'">Report an issue</a>';
        html +='<div class="clearfix"></div>';
        html +='</div>';
        html += '<div class="my-order">';
        html += '<div class="my-order-timeline">';
        html += '<div class="timeline">';
        html += '<div class="timeline-box">Delivered By :-</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="my-order-header">';
        html += '<div class="my-order-store">';
        html += '<span class="my-order-store-details">eBooks sTore, Kolkata</span>';
        html += '<span class="my-order-store-details dot">&bull;</span>';
        html += '<span class="my-order-store-details">Rs. '+orderDetails[i]['oder_amt']+'</span>';
        html += '</div>';
        html += '<div class="order-detail">';
        html += '<span class="my-order-store-details dot">Order ID: '+orderDetails[i]['payment_id']+'</span>';
        html += '<span class="my-order-store-details dot">&bull;</span>';
        html += '<span class="my-order-store-details dot">'+item_count[i]['item_count']+' items</span>';
        html += '</div>';
        html += '</div>';
        html += '<div class="my-order-list">';
        html += '<div class="my-order-list-item">';
        html += '<a href="orderlist.php?order_id='+orderDetails[i]['order_id']+'" class="order-list">';
        html += '<span class="order-list-item" order_id="'+orderDetails[i]['order_id']+'">View '+item_count[i]['item_count']+' items ordered <i class="fa fa-angle-right"></i></span>';
        html += '</a>';
        html += '</div>';
        html += '</div>';
        html += '<div class="clearfix"></div>';
        html += '</div>';

        html += '<div class="cart-box-details panel-group">';
        html += '<div class="cart-view-more panel panel-default">';
        html += '<div class="panel-heading">';
        html += '<h4 class="panel-title">';
        html += '<a data-toggle="collapse" href="#collapsel'+i+'">View Address and Billing Detail <i class="fa fa-angle-down"></i></a>';
        html += '</h4>';
        html += '</div>';
        html += '<div class="panel-collapse collapse" id="collapsel'+i+'">';
        html += '<ul class="list-group">';
        html += '<li class="list-group-item">';
        html += '<h4>Delivery Address:</h4>';
        html += '<p><b>'+orderDetails[i]['street1']+', '+orderDetails[i]['street2']+', '+orderDetails[i]['city']+','+orderDetails[i]['state_name']+' - '+orderDetails[i]['zip']+'</b></p>';
        html += '</li>';
        html += '<li class="list-group-item">';
        html += '<h4>Payment:</h4>';
        html += '<p><b><span class="pay">Subtotal:</span><span class="pay-amt">Rs. '+subtotal[i]+'</span></b></p>';
        html += '<p><b><span class="pay">Estimated Tax:</span><span class="pay-amt">Rs. '+tax+' </span></b></p>';
        html += '<p><b><span class="pay">Delivery:</span><span class="pay-amt" style="color: #43e684;">FREE</span></b></p>';
        html += '<p><b><span class="pay">Amount Payable:</span><span class="pay-amt">Rs. '+orderDetails[i]['oder_amt']+'</span></b></p>';
        html += '</li>';
        html += '</ul>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
       
      }
     
    }
    else
    {
      html += '<p class="book-price-prev" style="margin-left: 0;">Nothing yet Ordered.</p>';
    }
    $("#orderheader").append(html);
    
  });

  $('body').on('click','.report-issue',function(){
    var order_id = $(this).attr('payment_id');
    $("#ord_id").val(order_id);
    $("#hord_id").val(order_id);
    $('.error-display').hide();
    $("#reportIssueModal").modal('show');
  });

  $('body').on('click','#sendMail',function(){
    var subject = $('#eEmailTmpSubName').val();
    var desc = $('#eEmailTmpDesc').val();
    var payment_id =  $("#hord_id").val();
    var valid = 1;
    if(subject.trim()==''||subject.trim()==null||subject.trim()==undefined)
    {
      $(".eEmailTmpSubNameErr").text("Please Enter Subject.").show();
      valid = 0;
    }
    if(desc.trim()==''||desc.trim()==null||desc.trim()==undefined)
    {
      $(".eEmailTmpDescErr").text("Please Enter Description.").show(); 
      valid = 0;
    }
    if(valid==1)
    {
      run_waitMe(current_effect);// start the loader
      $.ajax({
      url: "book_class.php",
      type: 'POST',//method type
      dataType:'text',
      cache: false,//do not allow requested page to be cached
      data: {ajaxcall : true,function2call: 'sendMail',subject:subject,desc:desc,payment_id:payment_id}
    }).done(function(data)
    {
      data = JSON.parse(data);
      if(data.mail_sent==1)
      {
        displayAlert("Alert Message", "Mail Sent to our support team, They will get back to you.");
      }
    });
    }
  });
});
</script>
</body>
</html>      