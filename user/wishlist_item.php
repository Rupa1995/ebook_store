<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Ebook - Wishlist</title>
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
                        echo '<li><a href="book.php">Book</a></li>';
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
  <div class="clearfix"></div><hr>
  </div>
</div>
<div class="item container">
  <div>
    <p class="bag"><em>My Wishlist</em></p>
    <p class="total-price"><em id="payAmnt"></em></p>
    <div class="clearfix"></div>
    <div  id="book_detail"></div>
 </div>
</div>
<div class="modal fade" id="remove_confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabela" data-backdrop="static">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remove?</h4>
      </div>
      <div class="modal-body" id="delete_wish_body"> </div>
      <div class="modal-footer text-center">
        <input type="hidden" name="delete_wish_id" id="delete_wish_id">
        <button type="button" aria-label="Close" id="delete_confirm_yes" class="btn btn-sm btn-blue-yes" data-placement="top" data-toggle="tooltip" data-original-title ="">Yes</button>
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-navyblue-no" data-placement="top" data-toggle="tooltip" data-original-title ="" id="delete_confirm_no">No</button>
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
<script type="text/javascript">
$(document).ready(function()
{
    var current_effect = 'win8';
    run_waitMe(current_effect);// start the loader
    $.ajax({
        url: "book_class.php",
        type: 'POST',//method type
        dataType:'text',
        cache: false,//do not allow requested page to be cached
        data: {ajaxcall : true,function2call: 'getWishlist'}
      }).done(function(data)
      {
      data = JSON.parse(data);
      $('body').waitMe('hide');
      var html = '';
      var len = data.ebook.wishlistinfo.length;
      var wishlistinfo = data.ebook.wishlistinfo;
      var total_amt = 0;
      if(len>0)
      {
        for(var i=0; i<len; i++)
        {
          total_amt = total_amt+ parseInt(wishlistinfo[i]['book_mrp']);
          html += '<div class="book-detail" style="width: 70%;">';
          html += '<img src="'+wishlistinfo[i]['book_image']+'" class="book-img">';
          html += '<div class="book-details">';
          html += '<h2 class="book-name">'+wishlistinfo[i]['book_title']+'</h2>';
          html += '<p class="book-price">Rs. '+wishlistinfo[i]['book_mrp']+'</p>';
          html += '<p class="author_name">Author : '+wishlistinfo[i]['author_name']+'</p>';
          if(wishlistinfo[i]['book_quantity']==1)
          {
            html += '<p class="book-price-prev" style="margin-left: 0;">Only 1 unit in stock !</p>'
          }
          html +='<hr style="margin-top:50px">';
          html +='<a href="#" class="remove-link" value="'+wishlistinfo[i]['wish_id']+'">REMOVE</a>';
          html +='<a href="#" class="move-to-wishlist" value="'+wishlistinfo[i]['wish_id']+'">MOVE TO CART</a>';
          html += '</div>';
          html += '</div>';
        }  
      }
      else
      {
        html += '<p class="book-price-prev" style="margin-left: 0;">Nothing yet added to Wishlist.</p>';
      }
      
      $('#payAmnt').text('Rs. '+total_amt);
      $("#book_detail").append(html);
    });

$('body').on('click','.remove-link',function(){
  var wish_id = $(this).attr("value");
  $("#delete_wish_body").text("Are you sure want to remove from wishlist?");
  $("#delete_wish_id").val(wish_id);
  $("#remove_confirm").modal('show');
});

$('body').on('click','#delete_confirm_yes',function(){
  var wish_id = $('#delete_wish_id').val();
  $.ajax({
        url: "book_class.php",
        type: 'POST',//method type
        dataType:'text',
        cache: false,//do not allow requested page to be cached
        data: {ajaxcall : true,function2call: 'removeEntry',type_val : 1,running_id : wish_id}
      }).done(function(data)
      {
        $("#remove_confirm").modal('hide');
        data = JSON.parse(data);
        if(data.ebook.removeEntry==true)
        {
          location.reload(); 
        }
      });        
});

$('body').on('click','.move-to-wishlist',function(){
  var wish_id = $(this).attr("value");
  $.ajax({
      url: "book_class.php",
      type: 'POST',//method type
      dataType:'text',
      cache: false,//do not allow requested page to be cached
      data: {ajaxcall : true,function2call: 'moveEntry',type_val : 1,running_id : wish_id}
    }).done(function(data)
    {
      data = JSON.parse(data);
      if(data.ebook.moveEntry==true)
      {
        location.reload(); 
      }
    });
});
      
}); 
</script>
</body>
</html>
