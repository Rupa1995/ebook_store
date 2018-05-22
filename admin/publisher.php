<!DOCTYPE html>
<html>
<head>
  <title>Ebook - Publisher</title>
  <link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
 
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/waitMe.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/register.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/main.css">
</head>
<body id="body_log">
<div class="container">
  <div class="header-top">
    <div class="upper-header container">
      <div class="logo">
          <a href="home.php">
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
        Manage Publisher
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
                 <a href="#" id="create_pub" class="btn btn-orange mar-bot-10" title ="" data-placement="left" data-toggle="tooltip" data-original-title = ""><span class="glyphicon glyphicon-plus-sign " aria-hidden="true"></span> Add Publisher</a></div>
              </div>
            </div>
            <div class="table-responsive search-customer">
              <table class="table table-hover table-bordered">                 
                <thead>
                  <tr>
                    <th class="remove_sort" width="5%">No. </th>
                    <th id="b_sort_bookcat" class="sort_book" width="10%">Publisher Name</th>
                    <th class="remove_sort" width="9%">Action</th>
                  </tr>
                </thead>
                <tbody id="pubListTBody"></tbody>
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

<div class="modal fade form-modal" id="create_pub_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		    <div class="modal-header">
		      <button type="button" class="close page-scroll-set" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      <h4 class="modal-title">Add Publisher</h4>
		    </div>
		    <div class="modal-body"> 
		       <div class="form-group">
		        <div class="row">
		          <div class="col-sm-12">
		            <div class="col-sm-12 col-md-12 col-lg-12 ">
		              <label id="create_label">Publisher Name <span class="red">*</span></label>
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

<div class="modal fade form-modal" id="edit_pub_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		    <div class="modal-header">
		      <button type="button" class="close page-scroll-set" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      <h4 class="modal-title">Edit Publisher</h4>
		    </div>
		    <div class="modal-body"> 
		       <div class="form-group">
		        <div class="row">
		          <div class="col-sm-12">
		            <div class="col-sm-12 col-md-12 col-lg-12 ">
		              <label id="edit_label">Publisher Name <span class="red">*</span></label>
		              <input type="text" class="form-control" name="edit_val" id="edit_val" >
		              <p style="color:red" class="edit_valErr" id="edit_valErr"></p>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		    <div class="modal-footer text-center">
		      <button type="button" id="yes_edit" class="btn btn-sm btn-blue-yes" data-toggle="tooltip" data-original-title="">Yes</button>
		      <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-navyblue-no page-scroll-set" data-toggle="tooltip" data-original-title="">No</button>
		    </div>
    		<input type="hidden" name="type_val" id="type_val">
    		<input type="hidden" name="id_val" id="id_val">
    		<input type="hidden" name="old_pub_val" id="old_pub_val">
		</div>
	</div>
</div>
<div class="modal fade form-modal" id="deacticate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close page-scroll-set" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Deactivate</h4>
        </div>
        <div class="modal-body"> 
          <div class="form-group mar-b-0">
            <div id="sandbox-container">
             <span class="disp-blk p-b-15" id="profile_deact_text" name="profile_deact_text"></span>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
          <button type="button" id="yes_deac" class="btn btn-sm btn-blue-yes" data-toggle="tooltip" data-original-title="">Yes</button>
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-navyblue-no page-scroll-set" data-toggle="tooltip" data-original-title="">No</button>
        </div>
        <input type="hidden" name="deactPrfId" id="deactPrfId">
         <input type="hidden" name="deactProfileName" id="deactProfileName">
    </div>
  </div>
</div>

<div class="modal fade form-modal" id="activate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
<div class="modal-dialog modal-sm" role="document">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close page-scroll-set" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Activate</h4>
      </div>
      <div class="modal-body"> 
        <div class="form-group mar-b-0">
          <div id="sandbox-container">
              <span class="disp-blk p-b-15" id="profile_act_text" name="profile_act_text"></span>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
        <input type="hidden" name="actPrfId" id="actPrfId">
        <input type="hidden" name="actProfileName" id="actProfileName">
          <button type="button" id="yes_ac" class="btn btn-sm btn-blue-yes" data-toggle="tooltip" data-original-title="">Yes</button>
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-navyblue-no page-scroll-set" data-toggle="tooltip" data-original-title="">No</button>
        </div>
     </div>
  </div>
</div>


<script type='text/javascript' src="../js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../js/bootstrap.min.js"></script>
<script type='text/javascript' src="../js/bootstrap-select.min.js"></script>
<script type='text/javascript' src="../js/waitMe.js"></script>
<script type='text/javascript' src="../javascripts/manage_publisher.js"></script>
<script type='text/javascript' src="../javascripts/key_validation.js"></script>
<script type='text/javascript' src="../javascripts/comman.js"></script>
