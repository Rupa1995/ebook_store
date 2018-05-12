$(document).ready(function()
{
	$('#b_pubDate,#eb_pubDate').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
        autoclose: true
    });
	var offset = 0;
	var busy = false;
	var count = 0;
	var loading_flag = 0;
	var book_info;
	var total_count_flag = 1;
	var current_effect = 'win8';

	$('#bookListTBody').html('');  
	$('#current_record_count ').text('0');      
	displayRecords(offset);

$('#backid').on("click", function(){      
 window.location.href = "home.php";
});

$(window).bind('scroll', function() {   
var v= $('#page-wrapper').offset().top + $('#page-wrapper').outerHeight() - window.innerHeight;
var intvalue = Math.floor( v );
if($(window).scrollTop() >= intvalue -10 && !busy && loading_flag==0) {
 busy = true;             
 offset = 20 + offset; 
 displayRecords(offset);
}
});

$("#show_inactive").change(function () {
  total_count_flag   = 1;
  $('#current_record_count ').text('0');
  offset = 0;        
  $('#bookListTBody').html('');
   displayRecords(offset); 
});

function createBookValidation()
{
	var valid = 1;
	
	if(($('#b_name').val()=='') || ($('#b_name').val()==null))
	{
		valid = 0;
		$('#b_nameErr').text("Please enter Book Title.").show();
	}
	if(($('#b_price').val()=='') || ($('#b_price').val()==null))
	{
		valid = 0;
		$('#b_priceErr').text("Please enter Book Price.").show();
	}
	if(($('#b_pub option:selected').val().trim()=='') || ($('#b_pub option:selected').val().trim()==null))
	{
		valid = 0;
		$('#b_pubErr').text("Please select atleast one Publisher.").show();
	}
	if(($('#b_quan').val()=='') || ($('#b_quan').val()==null))
	{
		valid = 0;
		$('#b_quanErr').text("Please enter Book Quantity.").show();
	}
	else
	{
		if(($('#b_quan').val()<0))
		{
			valid = 0;
			$('#b_quanErr').text("Please enter Book Quantity more than 0 (zero).").show();
		}
	}	

	if(($('#b_auth option:selected').val().trim()=='') || ($('#b_auth option:selected').val().trim()==null))
	{
		valid = 0;
		$('#b_authErr').text("Please select atleast one Author.").show();
	}
	if(($('#b_cat option:selected').val().trim()=='') || ($('#b_cat option:selected').val().trim()==null))
	{
		valid = 0;
		$('#b_catErr').text("Please select atleast one Book Category.").show();
	}
	
	if(($('.b_pubDate').val().trim()=='') || ($('.b_pubDate').val().trim()==null))
	{
		valid = 0;
		$('#pubDateErr1').text("Please enter Published Date.").show();
	}
	var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
	var fileUpload = $("[name=profilePic]")[0];
	if(fileUpload.files[0]=='' || fileUpload.files[0]==undefined)
	{
		valid = 0;
		$("#profilePicErr").text("Please select images for book Cover image.").show();
	}
	else
	{
		if (!regex.test(fileUpload.value.toLowerCase())) 
		{
			$("#profilePicErr").text("Please select a valid Image file.").show();
		}
	}

	return valid;
}

function editBookValidation()
{
	var valid = 1;
	
	if(($('#eb_name').val()=='') || ($('#eb_name').val()==null))
	{
		valid = 0;
		$('#eb_nameErr').text("Please enter Book Title.").show();
	}
	if(($('#eb_price').val()=='') || ($('#eb_price').val()==null))
	{
		valid = 0;
		$('#eb_priceErr').text("Please enter Book Price.").show();
	}
	
	if(($('#eb_pub option:selected').val().trim())=='' || ($('#eb_pub option:selected').val().trim()) == null)
	{
		valid = 0;
		$('#eb_pubErr').text("Please select atleast one Publisher.").show();
	}
	if(($('#eb_quan').val()=='') || ($('#eb_quan').val()==null))
	{
		valid = 0;
		$('#eb_quanErr').text("Please enter Book Quantity.").show();
	}
	if(($('#eb_auth option:selected').val().trim()=='') || ($('#eb_auth option:selected').val().trim()==null))
	{
		valid = 0;
		$('#eb_authErr').text("Please select atleast one Author.").show();
	}
	if(($('#eb_cat option:selected').val().trim()=='') || ($('#eb_cat option:selected').val().trim()==null))
	{
		valid = 0;
		$('#eb_catErr').text("Please select atleast one Book Category.").show();
	}
	if(($('.eb_pubDate').val().trim()=='') || ($('.eb_pubDate').val().trim()==null))
	{
		valid = 0;
		$('#epubDateErr1').text("Please enter Published Date.").show();
	}
   
	return valid;
}

function displayRecords(offset)
{
	var flag = ($("#show_inactive").prop("checked") == true) ? 0 : 1;
	$('#loadingDiv').remove(); 
	$('#loader_message').html(''); 
	$('#loader_message').html('<div id="loadingDiv"><center><img src="../images/loader.gif" height="30px" width="30px"><p>Loading Please wait.</p></center></div>');          

	$.ajax({
	type: 'POST',//method type
	cache: false,//do not allow requested page to be cache
	data: {ajaxcall : true,function2call: 'getBookList', offset:offset,flag :flag , total_count_flag : total_count_flag},
	url: "book_class.php",
	}).done(function(data){
	$('#loadingDiv').remove();      
	html = '';
	busy =false;
	loading_flag = 0;
	data = JSON.parse(data);
	if(data.ebook.book_info!= null)
	{
		count = data.ebook.book_info.length;
		if(total_count_flag == 1){
		$('#total_records_count').text(data.ebook.bookCountList);
		}
		var current_count_text = $('#current_record_count ').text();
		var updated_current_count = parseInt(current_count_text) + count;
		$('#current_record_count').text(updated_current_count);
	 	if(data.ebook.book_info.length > 0)
	 	{                            
	      No = 0;                     
	      for(var i=0; i < count ; i++)
	      {
	      	if($('#show_inactive').is(':disabled')){
	  		  	$("#show_inactive").prop('disabled',false);
		    }

	        html += '<tr>';
			html += '<td>';
			html += ++No+offset;
			html += '</td>';
	                          
			html += '<td>';
			html += data.ebook.book_info[i].book_title;
			html += '</td>';
	                      
			html += '<td>';
			html += data.ebook.book_info[i].pub_name;
			html += '</td>';

			html += '<td>';
			html += data.ebook.book_info[i].author_name;
			html += '</td>';

			html += '<td>';
			html += data.ebook.book_info[i].cat_name;
			html += '</td>';

			html += '<td>';
			html += data.ebook.book_info[i].book_mrp;
			html += '</td>';

			html += '<td class="quant_val">';
			html += data.ebook.book_info[i].book_quantity;
			html += '</td>';

			html += '<td>';
			html += data.ebook.book_info[i].book_published_date;
			html += '</td>';

	        html += '<td class="action">';
	        
	        html += '<span data-toggle="tooltip" data-placement="top" title="Edit"><a href="#" class="editBook icon-green" id="'+data.ebook.book_info[i].book_id+'"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></a></span>';

	        if((flag == 0) || (flag == 1)){
	         html += '<span data-toggle="tooltip" data-placement="top" title="Update Quantity" ><a href="#" class="quant_op icon-red" id="'+data.ebook.book_info[i].book_id+'"><span  aria-hidden="true" class="glyphicon glyphicon-refresh"></span></a></span>';   
	        }
	                        
	        html +='<span data-toggle="tooltip" data-placement="top" title="List Logs"><a href="#" class="link_show_log_book icon-yellow" id="'+data.ebook.book_info[i].book_id+'"><span aria-hidden="true" class="fa fa-history"></span></a></span>';
	        
	        html += '</td>';
	        html += '</tr>';

	      }
	       	$('#bookListTBody').append(html);
	        $('[data-toggle="tooltip"]').tooltip();
	  	}
	  	else
	  	{
			loading_flag=1;

			$('#loadingDiv').remove();
			if( $('#bookListTBody').is(':empty') ) 
			{
				$("#contents").hide();
				$('#loader_message').html('<p style="margin-left:20px;color:red ;text-align: center;">No records found.</p>');
				if($('#show_inactive').is(':disabled'))
				{
					$("#show_inactive").prop('disabled',false);
				}
			}
			else
			{
				$('#loader_message').html('<p style="margin-left:20px;color:red ; text-align: center;">No more records.</p>');
			}
		} 
	}
	else
	{
		$('#total_records_count').text(0);
		if( $('#bookListTBody').is(':empty') ) 
		{
			$("#contents").hide();
			$('#loader_message').html('<p style="margin-left:20px;color:red ;text-align: center;">No records found.</p>');
			if($('#show_inactive').is(':disabled'))
			{
				$("#show_inactive").prop('disabled',false);
			}
		}
		else
		{
			$('#loader_message').html('<p style="margin-left:20px;color:red ; text-align: center;">No more records.</p>');
		}
	}     
	}).fail(function(){
		busy =false;
	});	 
	
}

$('body').on('click', '.quant_op', function(e){
	var book_id = $(this).attr('id');
	$('#book_id').val(book_id);
	var val = $(this).closest('td').siblings('.quant_val').text();
	$("#in_quan").val(val);
	$("#old_quan").val(val);
	$("#quantity").modal('show');
});

$('body').on("click",'#yes_quan', function(e){
	run_waitMe(current_effect);
	logData = new Array();
	oldDataInfo = new Array();
	oldDataInfo["quantity"] = $("#old_quan").val();
	data_old = {
          "quantity":escapeHtml(oldDataInfo["quantity"].trim()),       
        };           
                    
	data_new = {
          "quantity":escapeHtml($("#in_quan").val().trim()),      
        };

    log_data = filter(data_old, data_new),key;
    i = 0;
    for (key in log_data) {
        if (log_data.hasOwnProperty(key)) {
            logData[i++] = '"'+key+'":{"'+oldDataInfo[key]+'":"'+log_data[key]+'"}';
        }
    }
    if(logData.length > 0){
          logData ="{"+logData.join(",")+"}";
     }
    if(logData!='')
    {
		$.ajax({
		type: 'POST',//method type
		cache: false,//do not allow requested page to be cache
		data: {ajaxcall : true,function2call: 'increaseQuan', book_id : $("#book_id").val(),new_quan :$("#in_quan").val(),logData : logData},
		url: "book_class.php",
		}).done(function(data){
		data = JSON.parse(data);
		$('body').waitMe('hide');
		if(data.ebook.quant_chaned == true)
		{
			$('#quantity').modal('hide');
			displayRecords(offset);
		}
		}).fail(function(){

		});
    }
    else
    {
    	$('#quantity').modal('hide');
    }          

});

$('body').on("click",".link_show_log_book", function()
	{
		var book_id = $(this).attr('id');
		logLabels = new Array();
		logLabels['quantity'] = "Quantity";
		logLabels["book_title"] = "Book Title";
		logLabels["book_mrp"] = "MRP(₹)";
		logLabels["book_quantity"] = "Quantity";
		logLabels["author_name"] = "Author";
		logLabels["cat_name"] = "Book Category";
		logLabels["book_published_date"] = "Published Date";
		logLabels["pub_name"] = "Publisher Name";
		page_scroll_position = $(window).scrollTop(); // get page scroll position 
		run_waitMe(current_effect);// start the loader
		$.ajax({
		    url: "book_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    data: {ajaxcall : true,function2call: 'getBookLog',book_id:book_id}
		  }).done(function(data)
		  {
			$('body').waitMe('hide');
			$('#logAgr').modal('show');
			html = buildLogModal(data);
			$('#userLogTBodyCus').html(html);
		   
		  });
	});

function bookDetails(iauth,icat,ipub)
{
	run_waitMe(current_effect);// start the loader
		$.ajax({
	    url: "book_class.php",
	    type: 'POST',//method type
	    dataType:'text',
	    cache: false,//do not allow requested page to be cached
	    data: {ajaxcall : true,function2call: 'getBookDetailsList'}
	  }).done(function(data)
	  {
		data = JSON.parse(data);
		$('body').waitMe('hide');
		var auth = data.ebook.auth;
		var pub = data.ebook.pub;
		var cat = data.ebook.cat;
		$(iauth).html($("<option></option>")
             .attr("value"," ")
             .text("Select")); 
		$(icat).html($("<option></option>")
             .attr("value"," ")
             .text("Select"));
		$(ipub).html($("<option></option>")
             .attr("value"," ")
             .text("Select"));
		for(var i = 0; i<auth.length; i++)
	    {
	     $.each(auth[i], function(key, value) {
	      if(key == "author_id")
	      {
	        cid = value;
	      } 
	      if(key == 'author_name'){
	        $(iauth)
	         .append($("<option></option>")
	                    .attr("value",cid)
	                    .text(value)); 
	       }
	    });
	    }

    	for(var i = 0; i<pub.length; i++)
	    {
	     $.each(pub[i], function(key, value) {
	      if(key == "pub_id")
	      {
	        cid = value;
	      } 
	      if(key == 'pub_name'){
	        $(ipub)
	         .append($("<option></option>")
	                    .attr("value",cid)
	                    .text(value)); 
	       }
	    });
	    }

        for(var i = 0; i<cat.length; i++)
	    {
	     $.each(cat[i], function(key, value) {
	      if(key == "cat_id")
	      {
	        cid = value;
	      } 
	      if(key == 'cat_name'){
	        $(icat)
	         .append($("<option></option>")
	                    .attr("value",cid)
	                    .text(value)); 
	       }
	    });
	    }
		$(iauth).selectpicker('refresh');
		$(icat).selectpicker('refresh');			
	    $(ipub).selectpicker('refresh');
	});
}

$('body').on("click","#createBook", function()
	{
		bookDetails('#b_auth','#b_cat','#b_pub');
		$('.error-display').hide();
		$('#create_book_pop').modal('show');
	});

$('body').on("click","#add_book", function()
{
	var book_title = $("#b_name").val();
	var book_price = $("#b_price").val();
	var book_quant = $("#b_quan").val();
	var book_auth = $("#b_auth option:selected").val();
	var book_cat = $("#b_cat option:selected").val();
	var book_pub = $("#b_pub option:selected").val();
	var book_pub_date = $(".b_pubDate").val();
	var fileUpload = $("[name=profilePic]")[0];
	var valid = createBookValidation();

	if(valid == 1)
	{
		
		var dataimg = new FormData();
		dataimg.append('function2call', 'addBook');
		dataimg.append('book_title', book_title);
		dataimg.append('book_price', book_price);
		dataimg.append('book_quant', book_quant);
		dataimg.append('book_auth', book_auth);
		dataimg.append('book_cat', book_cat);
		dataimg.append('book_pub', book_pub);
		dataimg.append('book_pub_date', book_pub_date);
		dataimg.append('profilePic', fileUpload.files[0]);
		run_waitMe(current_effect);// start the loader
		$.ajax({
		 	url: "book_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    processData: false,
    		contentType: false,
		    data: dataimg,
		  }).done(function(data)
		  {
			data = JSON.parse(data);
			$('body').waitMe('hide');
			if(data.ebook.inserted == true)
			{
				$('#create_book_pop').modal('hide');
				displayAlert("Alert Message", "User successfully created.");
				displayRecords(offset);
			}   
		  });
	}
});	  

$('body').on('click','.editBook',function(){
	var book_id = $(this).attr('id');
	run_waitMe(current_effect);// start the loader
	$.ajax({
	    url: "book_class.php",
	    type: 'POST',//method type
	    dataType:'text',
	    cache: false,//do not allow requested page to be cached
	    data: {ajaxcall : true,function2call: 'getBookDetails',book_id:book_id}
	  }).done(function(data)
	  {
		data = JSON.parse(data);
		$('body').waitMe('hide');
		var auth = data.ebook.auth;
		var pub = data.ebook.pub;
		var cat = data.ebook.cat;
		book_info = data.ebook.book_info[0];
		for(var i = 0; i<auth.length; i++)
	    {
	     $.each(auth[i], function(key, value) {
	      if(key == "author_id")
	      {
	        cid = value;
	      } 
	      if(key == 'author_name'){
	        $('#eb_auth')
	         .append($("<option></option>")
	                    .attr("value",cid)
	                    .text(value)); 
	       }
	    });
	    }

    	for(var i = 0; i<pub.length; i++)
	    {
	     $.each(pub[i], function(key, value) {
	      if(key == "pub_id")
	      {
	        cid = value;
	      } 
	      if(key == 'pub_name'){
	        $('#eb_pub')
	         .append($("<option></option>")
	                    .attr("value",cid)
	                    .text(value)); 
	       }
	    });
	    }

        for(var i = 0; i<cat.length; i++)
	    {
	     $.each(cat[i], function(key, value) {
	      if(key == "cat_id")
	      {
	        cid = value;
	      } 
	      if(key == 'cat_name'){
	        $('#eb_cat')
	         .append($("<option></option>")
	                    .attr("value",cid)
	                    .text(value)); 
	       }
	    });
	    }
		$("#eb_name").val(book_info['book_title']);
		$("#eb_price").val(book_info['book_mrp']);
		$("#eb_quan").val(book_info['book_quantity']);
		$("#eb_auth").val(book_info['author_id']);
		$("#eb_cat").val(book_info['cat_id']);
		$("#eb_pub").val(book_info['pub_id']);
		$(".eb_pubDate").val(book_info['book_published_date']);
		$('#eb_auth').selectpicker('refresh');
		$('#eb_cat').selectpicker('refresh');			
		$('#eb_pub').selectpicker('refresh');
		
	});
	$('.error-display').hide();
	$("#edit_book_pop").modal('show');
});

$('body').on('click','#edit_book',function(){
	var valid = editBookValidation();
	logData = new Array();
	data_old = {
	      "book_title":book_info["book_title"].trim(),
	      "book_mrp":book_info["book_mrp"].trim(),
	      "book_quantity":book_info["book_quantity"].trim(),
	      "author_name":book_info["author_name"].trim(),
	      "cat_name":book_info["cat_name"].trim(),
	      "book_published_date":book_info["book_published_date"].trim(),
	      "pub_name":book_info["pub_name"].trim(),
	    };           
                        
	data_new = {
	      "book_title":escapeHtml($("#eb_name").val().trim()),
	      "book_mrp":escapeHtml($("#eb_price").val().trim()),
	      "book_quantity":escapeHtml($("#eb_quan").val().trim()),
	      "author_name":$("#eb_auth option:selected").text().trim(),
	      "cat_name":$("#eb_cat option:selected").text().trim(),
	      "book_published_date":escapeHtml($(".eb_pubDate").val().trim()),
	      "pub_name":$("#eb_pub option:selected").text().trim(),  
	    };
        
		log_data = filter(data_old, data_new),key;
		i = 0;
		for (key in log_data) {
		  if (log_data.hasOwnProperty(key)) {
		      logData[i++] = '"'+key+'":{"'+book_info[key]+'":"'+log_data[key]+'"}';
		  }
		}
		if(logData.length > 0){
		  logData ="{"+logData.join(",")+"}";
		}
		
	if(valid==1 && logData!='')
	{
		var ebook_title = $("#eb_name").val();
		var ebook_price = $("#eb_price").val();
		var ebook_quant = $("#eb_quan").val();
		var ebook_auth = $("#eb_auth option:selected").val();
		var ebook_cat = $("#eb_cat option:selected").val();
		var ebook_pub = $("#eb_pub option:selected").val();
		var ebook_pub_date = $(".eb_pubDate").val();
		
		var dataimg = new FormData();
		dataimg.append('function2call', 'editBook');
		dataimg.append('ebook_id', book_info['book_id']);
		dataimg.append('ebook_title', ebook_title);
		dataimg.append('ebook_price', ebook_price);
		dataimg.append('ebook_quant', ebook_quant);
		dataimg.append('ebook_auth', ebook_auth);
		dataimg.append('ebook_cat', ebook_cat);
		dataimg.append('ebook_pub', ebook_pub);
		dataimg.append('ebook_pub_date', ebook_pub_date);
		dataimg.append('logData', logData);
		
		run_waitMe(current_effect);// start the loader
		$.ajax({
		    url: "book_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    processData: false,
    		contentType: false,
		    data: dataimg,
		  }).done(function(data)
		  {
			data = JSON.parse(data);
			$('body').waitMe('hide');
			if(data.ebook.updated == true)
			{
				$('#edit_book_pop').modal('hide');
				displayAlert("Alert Message", "Book update successfully.");
			}
		  });
	}
		else
		{
			displayAlert("Alert Message", "Nothing Changed.");
		}		
	
});


$('body').on('click','.create_bPub',function(){
	$("#create_header").text('Create Publisher');
	$("#create_label").html('Publisher Name  <span class="red">*</span>');
	$("#type_val").val(1);
	$("#create").modal('show');

});

$('body').on('click','.create_bAuth',function(){
	$("#create_header").text('Create Author');
	$("#create_label").html('Author Name  <span class="red">*</span>');
	$("#type_val").val(2);
	$("#create").modal('show');
	
});

$('body').on('click','.create_bCat',function(){
	$("#create_header").text('Create Book Category');
	$("#create_label").html('Category Name <span class="red">*</span>');
	$("#type_val").val(3);
	$("#create").modal('show');
	
});

$('body').on('click','#yes_create',function()
{
	var name_type = $("#create_val").val().trim()
	if(name_type!='' && name_type!=null)
	{
	run_waitMe(current_effect);// start the loader
	$.ajax({
	    url: "book_class.php",
	    type: 'POST',//method type
	    dataType:'text',
	    cache: false,//do not allow requested page to be cached
	    data: {ajaxcall : true,function2call: 'createAttributes',type_val : $("#type_val").val(),name_type : name_type}
	  }).done(function(data)
	  {
		data = JSON.parse(data);
		$('body').waitMe('hide');
		if(data.ebook.updated == true)
			{
				bookDetails('#b_auth','#b_cat','#b_pub');
				$('#create').modal('hide');
			}
		else if(data.ebook.updated == 0)
			{
				$('#create').modal('hide');
				displayAlert("Alert Message", name_type+' already exits.');
			}	
	  });
	}
	else
	{
		$("#create_valErr").text("Please enter value.")
	}  
});

$('body').on('click','#confirm_ok',function(){
	offset = 0;
	$('#bookListTBody').html('');
	$('#current_record_count ').text('0');
	displayRecords(offset);
});


$('.profilePic').on('change', function(){
  var upload_pic_name =$('.profilePic').val().replace(/C:\\fakepath\\/i, ''); 
  if(upload_pic_name == '')
  {
     $("#profilePic_filename").text("No file selected.");
  }
  else
  {
    $("#profilePic_filename").text(upload_pic_name);
    $('.profilePic').attr('title' ,upload_pic_name);
  }
});

$('.resetprofilePic').on('click', function(e){
    e.preventDefault();
    $("#profilePic_filename").text("No file selected.");
    $('.profilePic').attr('title' ,'No file selected');
    $('#profilePicErr').hide();
    $('.profilePic').val('');
    $('input[type=file]').val('');
});


});
