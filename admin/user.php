<!DOCTYPE html>
<html>
<head>
  <title>Ebook - Edit Profile</title>
  <link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
 
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="../css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/waitMe.css">
  
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
          <a href="index.php">
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
                        echo '<li><a href="edit_profile.php">Edit Profile</a></li>';
                        echo '<li><a href="#">Wishlist</a></li>';
                        echo '<li><a href="#">Cart</a></li>';
                        echo '<li><a href="logout.php" class="login_user">Logout</a></li>';
                      } 
                      else
                      { 
                        echo '<li><a href="register.php?action=logout" class="register_user">Login/SignUp</a></li>';
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
      <div class="title">
        <div class="pull-right">   
              <a href="#" id="backid" class="form-group btn btn-sm btn-default-back" title ="" data-placement="top" data-toggle="tooltip" data-original-title="">
              <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back </a>
        </div>
      </div>
      
      <form class="form-horizontal input">
        <div class="content-main">        
          <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="checkbox" style="margin-left:10px">
                    <label><input type ="checkbox" name="show_inactive" id="show_inactive" class="styled"> Show inactive records</label>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="pull-right"> 
                  <span class="total-records">Showing Records <span id="current_record_count">0</span> of <span id="total_records_count">0</span></span>
                 <a href="" id="createUser" class="btn btn-orange mar-bot-10" title ="" data-placement="left" data-toggle="tooltip" data-original-title = ""><span class="glyphicon glyphicon-plus-sign " aria-hidden="true"></span> Create User</a></div>
              </div>
            </div>
            <div class="table-responsive search-customer">
              <table class="table table-hover table-bordered">                 
                <thead>
                  <tr>
                    <th class="remove_sort" width="5%">No. </th>
                    <th id="u_sort_firstname" class="sort_user" width="10%">First Name</th>
                    <th id="u_sort_lastname" class="sort_user" width="10%">Last Name</th>
                    <th id="u_sort_username" class="sort_user" width="10%">User Name</th>
                    <th class="remove_sort" width="9%">Action</th>
                  </tr>
                </thead>
                <tbody id="userListTBody"></tbody>
              </table>
            </div>
          </div>
           <div id="loader_message"></div>
          </div>
        </div>
      </form>
    </div>
<a href="#" class="scrollToTop">Scroll To Top</a> 
<!-- Autocomplete -->

<script type='text/javascript' src="../js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../js/bootstrap.min.js"></script>
<script type='text/javascript' src="../js/bootstrap-select.min.js"></script>

<script type='text/javascript' src="../javascripts/edit_profile.js"></script>
<script type='text/javascript' src="../javascripts/key_validation.js"></script>
<script type='text/javascript' src="../javascripts/comman.js"></script>>
<script type="text/javascript">
   $('body').waitMe('hide');
</script>
