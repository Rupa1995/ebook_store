<?php
  
	session_start();
  $current_user = $_SESSION['userID'];
  if(!isset($_SESSION['login_user']))
  {
    header("location: ../register.php?action=logout");
  }
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
      <div class="title">Books</div>
      <div class="search-bx">
        <div class="row">
          <div class="col-lg-12 col-md-12">
             <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                  <label>Book Category <span class="red">*</span></label>
                  <div class="form-group">
                    <select class="selectpicker form-control" data-selected-text-format="count" data-actions-box="true" multiple name="b_pub" id="b_pub">
                    </select>
                    <span class="red"><p class="error-display author_nameErr"></p></span>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-3  col-xs-12 text-right">
                  <button class="btn btn-sm btn-blue" style="margin-top: 25px;" id="okBtn" type="button" title ="" data-placement="top" data-toggle="tooltip" data-original-title="">OK</button>
                </div>
              </div>
           </div>
        </div>
      </div>
      	<div class="content-main" id='book_list'>
          <p class="red" style="margin-left:10px";>Please select Book Category to display Books.</p>
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
<script type="text/javascript">
$(document).ready(function()
{
  run_waitMe('win8');// start the loader
    $.ajax({
      url: "../admin/book_class.php",
      type: 'POST',//method type
      dataType:'text',
      cache: false,//do not allow requested page to be cached
      data: {ajaxcall : true,function2call: 'getBookDetailsList'}
    }).done(function(data)
    {
      data = JSON.parse(data);
      $('body').waitMe('hide');
      var cat = data.ebook.cat;
      
      for(var i = 0; i<cat.length; i++)
        {
         $.each(cat[i], function(key, value) {
          if(key == "cat_id")
          {
            cid = value;
          } 
          if(key == 'cat_name'){
            $("#b_pub")
             .append($("<option></option>")
                        .attr("value",cid)
                        .text(value)); 
           }
        });
        }
      $("#b_pub").selectpicker('refresh');    

    });

$('body').on('click','#okBtn',function()
  {
    var selectedValues = [];    
    $("#b_pub option:selected").each(function(){
        selectedValues.push("'"+$(this).val()+"'"); 
    });
    selectedValues = selectedValues.join();
    var html = '';
    if(selectedValues.length>0)
    {
          run_waitMe('win8');// start the loader
    $.ajax({
      url: "book_class.php",
      type: 'POST',//method type
      dataType:'text',
      cache: false,//do not allow requested page to be cached
      data: {ajaxcall : true,function2call: 'booklistCat', selectedValues : selectedValues}
    }).done(function(data)
    {
      data = JSON.parse(data);
      $('body').waitMe('hide');
      count = data.ebook.boot_list.length;
      if(count>0)
        { 
          for (var i = 0; i < count; i++) 
          { 
            if(data.ebook.boot_list[i].cart_id!='')
            {
              var cart_class = "icon-red";
              var cart_title = "Added To Cart";
            }
            else
            {
              var cart_class = ""; 
              var cart_title = "Add To Cart";
            }

            if(data.ebook.boot_list[i].wish_id!='')
            {
              var wish_class = "icon-red";
              var wish_title = "Added To Wishlist";
            }
            else
            {
              var wish_class = ""; 
              var wish_title = "Add To Wishlist";
            }

             html += '<div class="admin-box" id="">';
             html += '<div class="panel panel-back noti-box">';
             html += '<div class="image-logo"><a href =""><img src="'+data.ebook.boot_list[i].book_image+'">';
             html += '<div class ="overlay image-title"><h3><b>'+data.ebook.boot_list[i].book_title+'</b></h3></div>'; 
             html += '</a></div>';
             html += '<button class="btn-cart" title ="'+cart_title+'" data-placement="top" data-toggle="tooltip" data-original-title="" id="'+data.ebook.boot_list[i].book_id+'"><i class="fa fa-cart-plus '+cart_class+'"></i></button>';
             html += '<button class="btn-wish" title ="'+wish_title+'" data-placement="top" data-toggle="tooltip" data-original-title="" id="'+data.ebook.boot_list[i].book_id+'"><i class="fa fa-heart '+wish_class+'"></i></button>';
             html += '</div>';
             html += '</div>';
          }
        }
        else
        {
           html += '<p class="red" style="margin-left:10px">There is no book available.</p>';      
        }

        $("#book_list").html(html);
    });
    }
    else
    {
      html += '<p class="red" style="margin-left:10px">Please select Book Category to display Books.</p>'; 
      $("#book_list").html(html);     
    }
    
  });

});
</script>
</body>
</html>