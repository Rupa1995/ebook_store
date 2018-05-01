<?php
	session_start();
  if(isset($_GET['uid'])){
	$user_id = $_GET['uid'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Ebook - Edit Profile</title>
  <link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
 
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/waitMe.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/register.css">
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

  <div class="modal fade" id="edit_profile_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabelc">Edit Profile</h4>
        </div>
        <form class="form-horizontal input" action="#" name="updateUserForm" id="updateUserForm" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="content-main">  
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>First Name <span class="red">*</span></label>
                  <input type="text" class="form-control" placeholder="" name="upFirstName" id="upFirstName" onKeyPress="return userFirstNameKey(event)">
                  <p style="color:red" class="eFirstNameErr error-display" id="eFirstNameErr"></p>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>Last Name <span class="red">*</span></label>
                  <input type="text" class="form-control" placeholder="" name="upLastName" id="upLastName" onKeyPress="return userLastNameKey(event)">
                 <p style="color:red" class="eLastNameErr error-display" id="eLastNameErr"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6 col-md-12 col-lg-12">
                  <label>Address <span class ="red">*</span></label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6 col-md-12 col-lg-12">
                  <label>Street Address 1 <span class="red">*</span></label>
                  <input type="text" class="form-control" placeholder="Street 1" name="upStreet1" id="upStreet1" onKeyPress="return street1Key(event)">
                  <input type="hidden" name="upStreet1Copy" id="upStreet1Copy">
                  <p style="color:red" class="estreet1Err error-display" id="estreet1Err"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6 col-md-12 col-lg-12">
                  <label>Street Address 2</label>
                  <input type="text" class="form-control" placeholder="Street 2" name="upStreet2" id="upStreet2" onKeyPress="return street2Key(event)">
                  <input type="hidden" name="upStreet2Copy"  id="upStreet2Copy">
                  <p style="color:red" class="estreet2Err error-display" id="estreet2Err"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6 col-md-6 col-lg-6">
                 <label>City <span class="red">*</span></label>
                  <input type="text" class="form-control" placeholder="" name="upCity" id="upCity" onKeyPress="return cityKey(event)">
                  <input type="hidden" name ="upCityCopy" id ="upCityCopy">
                  <p style="color:red" class="eCityErr error-display" id="eCityErr"></p>
                </div>
                 <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>Country <span class="red">*</span></label>
                    <div class="dropDown_hover">
                      <select class="selectpicker form-control" name="upCountry" id="upCountry">
                        <option value="">Select</option>
                      </select>
                     <p style="color:red" class="upCountryErr error-display" id="upCountryErr"></p>
                  </div>
                </div>            
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>State <span class="red">*</span></label>
                    <div class="dropDown_hover">
                      <select class="selectpicker form-control" name="upState" id="upState">
                        <option value="">Select</option>
                      </select>
                    <p style="color:red" class="upStateErr error-display" id="upStateErr"></p>
                  </div>
                </div>  
                 <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>Region / Area</label>
                  <input type="text" class="form-control" placeholder="" name="upRegion" id="upRegion" onKeyPress="return areaKey(event)">
                  <input type="hidden" name ="upRegionCopy" id ="upRegionCopy">
                  <p style="color:red" class="upRegionErr error-display" id="upRegionErr"></p>                  
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                 <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>Postal / Zip code <span class="red">*</span></label>
                  <input type="text" class="form-control" placeholder="" name="upZipCode" id="upZipCode" onKeyPress="return zipCodeKey(event)" maxlength="50">
                 <p style="color:red" class="eZipCodeErr error-display" id="eZipCodeErr"></p>
                </div>
                 <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>Contact Number <span class="red">*</span></label>
                  <input type="text" class="form-control" placeholder="" name="upContactNo" id="upContactNo" onKeyPress="return contactNoKey(event)">
                  <p style="color:red" class="eContactNoErr error-display" id="eContactNoErr"></p>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <div class="modal-footer">
              <div class="pull-right">
                <button class="btn btn-sm green-btn" id="editupload"  type="submit" data-toggle="tooltip" data-original-title="">Save</button>
                <button class="btn btn-grey btn-sm page-scroll-set"  data-dismiss="modal" aria-label="Close" type="button" data-toggle="tooltip" id="cancel" data-original-title="">Cancel</button>
              </div>
        </div>
        </form>
      </div>
    </div>
  </div>


<!-- alert modal starts here -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabela" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
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
          <button type="button" id = "confirm_ok" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-navyblue" data-placement="top" data-toggle="tooltip" data-original-title ="OK">OK</button>
        </div>
      </div>
    </div>
  </div>

<script type='text/javascript' src="js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="js/bootstrap.min.js"></script>
<script type='text/javascript' src="js/bootstrap-select.min.js"></script>
<script type='text/javascript' src="js/waitMe.js"></script>
<script type='text/javascript' src="javascripts/edit_profile.js"></script>
<script type='text/javascript' src="javascripts/key_validation.js"></script>
<script type='text/javascript' src="javascripts/comman.js"></script>

<script type="text/javascript">
	var user_id= <?php echo $user_id;?>;
</script>
</body>
</html.