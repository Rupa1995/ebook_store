<!DOCTYPE html>
<html>
<head>
  <title>Ebook - Book List</title>
  <link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
 
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/waitMe.css">
  <link rel="stylesheet" type="text/css" href="../css/datepicker.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/register.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/main.css">
</head>
<body id="body_log">
<div class="container">
  <div class="header-top">
    <div class="upper-header container">
      <div class="logo">
          <a href="index.php">
            <h1>Books</h1>
            <span>eBook sTore</span>
          </a>
      </div>  
    </div>
  <div class="clearfix"></div>
  </div>
</div>
  <div id="page-wrapper" class="full-width">
    <div class="right-panel">         
      <div class="title">
        Manage Book List
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
                 <a href="#" id="createBook" class="btn btn-orange mar-bot-10" title ="" data-placement="left" data-toggle="tooltip" data-original-title = ""><span class="glyphicon glyphicon-plus-sign " aria-hidden="true"></span> Add Book</a></div>
              </div>
            </div>
            <div class="table-responsive search-customer">
              <table class="table table-hover table-bordered">                 
                <thead>
                  <tr>
                    <th class="remove_sort" width="5%">No. </th>
                    <th id="b_sort_title" class="sort_book" width="10%">Book Title</th>
                    <th id="b_sort_pubname" class="sort_book" width="10%">Publisher Name</th>
                    <th id="b_sort_authname" class="sort_book" width="10%">Author Name</th>
                    <th id="b_sort_bookcat" class="sort_book" width="10%">Book Category</th>
                    <th id="b_sort_mrp" class="sort_book" width="10%">MRP(₹)</th>
                    <th id="b_sort_quant" class="sort_book" width="10%">Quantity</th>
                    <th id="b_sort_pubdate" class="sort_book" width="10%">Published Date</th>
                    <th class="remove_sort" width="9%">Action</th>
                  </tr>
                </thead>
                <tbody id="bookListTBody"></tbody>
              </table>
            </div>
          </div>
           <div id="loader_message"></div>
          </div>
        </div>
      </form>
    </div>
<a href="#" class="scrollToTop">Scroll To Top</a> 

<!-- log modal -->
<div class="modal fade info-modal" id="logAgr" tabindex="-1" role="dialog" aria-labelledby="myModalLabela" data-backdrop="static">
<div class="modal-dialog modal-sm" role="document" style="width: 30%;">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close page-scroll-set" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Log List</h4>
    </div>
    <div class="modal-body select-agre" style=" max-height: 478px;overflow-y: auto;"> 
    <div class="form-group mar-b-0">
        <div id="sandbox-container">
            <div id="userLogTBodyCus"></div>
        </div>
      </div>
    </div>
    <div class="modal-footer text-center">
      <button type="button" data-dismiss="modal" id="logClose" aria-label="Close" class="btn btn-sm btn-grey page-scroll-set" data-toggle="tooltip" data-original-title="">Close</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade form-modal" id="quantity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close page-scroll-set" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Book Quatity</h4>
        </div>
        <div class="modal-body"> 
           <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-12 col-md-12 col-lg-12 ">
                  <label>Quantity <span class="red">*</span></label>
                  <input type="number" class="form-control" name="in_quan" id="in_quan" >
                  <span class="red"><p class="in_quanErr" id="in_quanErr"></p></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
          <button type="button" id="yes_quan" class="btn btn-sm btn-blue-yes" data-toggle="tooltip" data-original-title="">Yes</button>
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-navyblue-no page-scroll-set" data-toggle="tooltip" data-original-title="">No</button>
        </div>
        <input type="hidden" name="book_id" id="book_id">
        <input type="hidden" name="old_quan" id="old_quan">
    </div>
  </div>
</div>

<div class="modal fade form-modal" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" style="z-index: 1051;">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close page-scroll-set" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="create_header"></h4>
        </div>
        <div class="modal-body"> 
           <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-12 col-md-12 col-lg-12 ">
                  <label id="create_label"></label>
                  <input type="text" class="form-control" name="create_val" id="create_val" >
                  <p style="color:red" class="create_valErr" id="create_valErr"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
          <button type="button" id="yes_create" class="btn btn-sm btn-blue-yes" data-toggle="tooltip" data-original-title="">Yes</button>
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-navyblue-no page-scroll-set" data-toggle="tooltip" data-original-title="">No</button>
        </div>
        <input type="hidden" name="type_val" id="type_val">
    </div>
  </div>
</div>



<div class="modal fade" id="create_book_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" style="z-index: 1050;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabelc">Add Book</h4>
      </div>
       <form class="form-horizontal input" action="#" name="createBookForm" id="createBookForm" method="POST" enctype="multipart/form-data">
      <div class="modal-body overflow-nohidden">
        <div class="content-main overflow-nohidden">  
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Book Title <span class="red">*</span></label>
                <input type="text" class="form-control" placeholder="" name="b_name" id="b_name" onKeyPress="return userFirstNameKey(event)">
                <p style="color:red" class="b_nameErr error-display" id="b_nameErr"></p>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>MRP(₹) <span class="red">*</span></label>
                <input type="text" class="form-control" placeholder="" name="b_price" id="b_price" onKeyPress="return userLastNameKey(event)">
               <p style="color:red" class="b_priceErr error-display" id="b_priceErr"></p>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group" id="internalUser">
          <div class="row class">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Publisher Name <span class="red">*</span></label>
                  <div class="dropDown_hover">
                    <select class="selectpicker form-control" name="b_pub" id="b_pub">
                      <option value="">Select</option>
                    </select>
                    <a data-toggle="tooltip" data-placement="top" title="" id="prConLink" style="" class="create_bPub" href="#"><i class="fa fa-plus-circle"></i> Create Publisher</a>
                    <p style="color:red" class="b_pubErr error-display" id="b_pubErr"></p>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <label>Quantity <span class="red">*</span></label>
                <input type="number" class="form-control" name="b_quan" id="b_quan" >
                <p style="color:red" class="b_quanErr error-display" id="b_quanErr"></p>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
               <label>Author Name <span class="red">*</span></label>
                <select class="selectpicker form-control" name="b_auth" id="b_auth">
                  <option value="">Select</option>
                </select>
                <a data-toggle="tooltip" data-placement="top" title="" id="prConLink" style="" class="create_bAuth" href="#"><i class="fa fa-plus-circle"></i> Create Author</a>
                <p style="color:red" class="b_authErr error-display" id="b_authErr"></p>
              </div>
               <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Book Category <span class="red">*</span></label>
                  <div class="dropDown_hover">
                    <select class="selectpicker form-control" name="b_cat" id="b_cat">
                      <option value="">Select</option>
                    </select>
                    <a data-toggle="tooltip" data-placement="top" title="" id="prConLink" style="" class="create_bCat" href="#"><i class="fa fa-plus-circle"></i> Create Book Category </a>
                   <p style="color:red" class="b_catErr error-display" id="b_catErr"></p>
                </div>
              </div>            
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
              <label>Publication Date <span class="red">*</span></label>
               <div id="b_pubDate" class="input-append date date_timepicker fromDate1">
                  <input type="text" placeholder="YYYY-MM-DD" data-format="YYYY-MM-DD" class="date_inp b_pubDate form-control" name="fromDate1" id="fromDate1">
                  <span class="add-on calendar-icon tog_class">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </i>
                  </span>  
                  <p style="color:red" class="pubDateErr1 error-display" id="pubDateErr1"></p>
                </div>  
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
                  <input type="file" id="profilePic" name="profilePic" class="profilePic"  value="">
                </div>
                  <span id ="profilePic_filename" class ="profilePic_filename"> No file selected. </span>
                   <div style="margin-top: 4px;">
                       <button id="resetprofilePic" class ="btn btn-default resetprofilePic">Reset File
                      </button> 
                    </div>
                  <p style="color:red" class="profilePicErr error-display" id="profilePicErr"></p>
                <div> 
                  <span style="color:#23527C"><i>(Image dimension:300px*300px. Allowed image format: jpg, jpeg, png and gif)</i></span>
                </div>
              </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="pull-right">
          <button class="btn btn-sm green-btn" id="add_book"  type="button" data-toggle="tooltip" data-original-title="">Create</button>
          <button class="btn btn-grey btn-sm page-scroll-set"  data-dismiss="modal" aria-label="Close" type="button" data-toggle="tooltip" id="cancel" data-original-title="">Cancel</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="edit_book_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabelc">Edit Book</h4>
      </div>
       <form class="form-horizontal input" action="#" name="updateUserForm" id="updateUserForm" method="POST" enctype="multipart/form-data">
      <div class="modal-body overflow-nohidden">
        <div class="content-main overflow-nohidden">  
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Book Title <span class="red">*</span></label>
                <input type="text" class="form-control" placeholder="" name="eb_name" id="eb_name" onKeyPress="return userFirstNameKey(event)">
                <p style="color:red" class="eb_nameErr error-display" id="eb_nameErr"></p>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>MRP(₹) <span class="red">*</span></label>
                <input type="text" class="form-control" placeholder="" name="eb_price" id="eb_price" onKeyPress="return userLastNameKey(event)">
               <p style="color:red" class="eb_priceErr error-display" id="eb_priceErr"></p>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row class">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Publisher Name <span class="red">*</span></label>
                  <div class="dropDown_hover">
                    <select class="selectpicker form-control" name="eb_pub" id="eb_pub">
                      <option value="">Select</option>
                    </select>
                   <p style="color:red" class="eb_pubErr error-display" id="eb_pubErr"></p>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3">
                <label>Quantity <span class="red">*</span></label>
                <input type="number" class="form-control" name="eb_quan" id="eb_quan" >
                <p style="color:red" class="eb_quanErr error-display" id="eb_quanErr"></p>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
               <label>Author Name <span class="red">*</span></label>
                <select class="selectpicker form-control" name="eb_auth" id="eb_auth">
                  <option value="">Select</option>
                </select>
                <p style="color:red" class="eb_authErr error-display" id="eb_authErr"></p>
              </div>
               <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Book Category <span class="red">*</span></label>
                  <div class="dropDown_hover">
                    <select class="selectpicker form-control" name="eb_cat" id="eb_cat">
                      <option value="">Select</option>
                    </select>
                   <p style="color:red" class="eb_catErr error-display" id="eb_catErr"></p>
                </div>
              </div>            
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
              <label>Publication Date <span class="red">*</span></label>
               <div id="eb_pubDate" class="input-append date date_timepicker fromDate1">
                  <input type="text" placeholder="YYYY-MM-DD" data-format="YYYY-MM-DD" class="date_inp eb_pubDate form-control" name="fromDate" id="fromDate">
                  <span class="add-on calendar-icon tog_class">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </i>
                  </span>  
                  <p style="color:red" class="epubDateErr1 error-display" id="epubDateErr1"></p>
                </div>  
              </div>
            </div>
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <div class="pull-right">
          <button class="btn btn-sm green-btn" id="edit_book"  type="button" data-toggle="tooltip" data-original-title="">Save</button>
          <button class="btn btn-grey btn-sm page-scroll-set"  data-dismiss="modal" aria-label="Close" type="button" data-toggle="tooltip" id="cancel" data-original-title="">Cancel</button>
        </div>
      </div>
    </form>
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


<script type='text/javascript' src="../js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../js/bootstrap.min.js"></script>
<script type='text/javascript' src="../js/bootstrap-select.min.js"></script>
<script type='text/javascript' src="../js/waitMe.js"></script>
<script type='text/javascript' src="../js/bootstrap-datepicker.js"></script>
<script type='text/javascript' src="../javascripts/manage_book.js"></script>
<script type='text/javascript' src="../javascripts/key_validation.js"></script>
<script type='text/javascript' src="../javascripts/comman.js"></script>
