<?php
	session_start();
  if(isset($_GET['uid'])){
	$user_id = $_GET['uid'];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Ebook Store - SignUp</title>
  <link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="stylesheets/register.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
         <div class="modal-body" style="overflow-y: scroll; height: 500px;" >
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>First Name </label>
                  <input type="text" class="form-control" placeholder="" name="middleName" id="middleName" onKeyPress="return userMiddleNameKey(event)">
                  <span class="red"><p class="middleNameErr error-display" id="middleNameErr"></p></span>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>Last Name <span class="red">*</span></label>
                  <input type="text" class="form-control" placeholder="" name="lastName" id="lastName" onKeyPress="return userLastNameKey(event)">
                  <span class="red"><p class="lastNameErr error-display" id="lastNameErr"></p></span>
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
                  <span class="red"><p class="estreet1Err error-display" id="estreet1Err"></p></span>
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
                  <span class="red"><p class="estreet2Err error-display" id="estreet2Err"></p></span>
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
                  <span class="red"><p class="eCityErr error-display" id="eCityErr"></p></span>
                </div>
                 <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>Country</label>
                    <div class="multi-cust-select1 dropDown_hover">
                      <select class="multiselect custom form-control" name="upCountry" id="upCountry">
                        <option value="">Select</option>
                      </select>
                     <input type="hidden" name="upCountryCopy" id="upCountryCopy">
                  </div>
                </div>            
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6 col-md-6 col-lg-6 block" id="upStateText">
                   <label>State <span class="red">*</span></label><input type="text" class="form-control" placeholder="" name="upState1" id="upState1" onKeyPress="return stateKey(event)"><span class="red"><p class="error-display eStateErr1"></p></span></div>
                 <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>Region / Area</label>
                  <input type="text" class="form-control" placeholder="" name="upRegion" id="upRegion" onKeyPress="return areaKey(event)">
                  <input type="hidden" name ="upRegionCopy" id ="upRegionCopy">
                  <span class="red"><p class="upRegionErr error-display" id="upRegionErr"></p></span>
                  
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
                  <input type="hidden" name="upZipCodeCopy" id="upZipCodeCopy">
                  <span class="red"><p class="eZipCodeErr error-display" id="eZipCodeErr"></p></span>
                </div>
                 <div class="col-sm-6 col-md-6 col-lg-6">
                  <label>Contact Number </label>
                  <input type="text" class="form-control" placeholder="" name="upContactNo" id="upContactNo" onKeyPress="return contactNoKey(event)">
                  <span class="red"><p class="eContactNoErr error-display" id="eContactNoErr"></p></span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6 col-md-5 col-lg-12">
                  <label>Upload Photo</label>
                  <div class="clearfix"></div>                  
                  <div id="uplaoadUserFile"> 
                   <div class="btn btn-default btn-file "> Choose a file
                    <input type="file" id="upProfilePic" name="upProfilePic">
                    <input type="hidden" id="upProfilePic_check" name="upProfilePic_check">
                  </div>
                    <span id ="upProfilePic_filename" class ="upProfilePic_filename"> No file selected. </span>
                      <div style="margin-top: 4px;">
                         <button class="btn btn-default upresetprofilePic"
                              id="upresetprofilePic" >Reset File
                        </button> 
                      </div>
                    <span class="red"><p class="error-display eProfilePicErr" id="eProfilePicErr"></p></span>
                  <div> 
                    <span style="color:#23527C">
                      <i>(Image dimension:300px*300px. Allowed image format: jpg, jpeg, png and gif)</i>
                    </span>
                  </div> 
                </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="pull-right">
              <button class="btn btn-sm green-btn" id="editupload"  type="submit" data-toggle="tooltip" data-original-title="">Save</button>
              <button class="btn btn-grey btn-sm page-scroll-set"  data-dismiss="modal" aria-label="Close" type="button" data-toggle="tooltip" data-original-title="">Cancel</button>
            </div>
        </div>
        </div>
    </div>
  </div>

<script src="javascripts/edit_profile.js"></script>
<script type="text/javascript">
	var user_id= <?php echo $user_id;?>;
</script>