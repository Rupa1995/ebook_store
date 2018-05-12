$(document).ready(function()
{

	var offset = 0;
	var busy = false;
	var count = 0;
	var loading_flag = 0
	var total_count_flag = 1;
	var current_effect = 'win8';

	$('#pubListTBody').html('');  
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
  $('#pubListTBody').html('');
   displayRecords(offset); 
});


function displayRecords(offset)
{
	var flag = ($("#show_inactive").prop("checked") == true) ? 0 : 1;
	$('#loadingDiv').remove(); 
	$('#loader_message').html(''); 
	$('#loader_message').html('<div id="loadingDiv"><center><img src="../images/loader.gif" height="30px" width="30px"><p>Loading Please wait.</p></center></div>');          

	$.ajax({
	type: 'POST',//method type
	cache: false,//do not allow requested page to be cache
	data: {ajaxcall : true,function2call: 'getPublisherList', offset:offset,flag :flag , total_count_flag : total_count_flag},
	url: "book_class.php",
	}).done(function(data){
	$('#loadingDiv').remove();      
	html = '';
	busy = false;
	data = JSON.parse(data); 
	count = data.ebook.publisher.length;
	
	if(total_count_flag == 1){
	$('#total_records_count').text(data.ebook.pubCountList);
	}
	var current_count_text = $('#current_record_count ').text();
	var updated_current_count = parseInt(current_count_text) + count;
	$('#current_record_count').text(updated_current_count);
 	if(data.ebook.publisher.length > 0)
 	{                            
      No = 0;                     
      for(var i=0; i < count ; i++)
      {
      	if(data.ebook.publisher[i].pub_isactive == '1')
		{
		if($('#show_inactive').is(':disabled'))
		{
			$("#show_inactive").prop('disabled',false);
		}
		}	
		color = '';
		title = 'Deactivate';                     
		if(data.ebook.publisher[i].pub_isactive == '0')
		{
		color = "red";
		title = 'Activate';
		if($('#show_inactive').is(':disabled'))
			{
		    $("#show_inactive").prop('disabled',false);
			}
		}
        html += '<tr>';
		html += '<td>';
		html += ++No+offset;
		html += '</td>';
                          
		html += '<td class="pub_name">';
		html += data.ebook.publisher[i].pub_name;
		html += '</td>';
                      
        html += '<td class="action">';
        
        html += '<span data-toggle="tooltip" data-placement="top" title="Edit"><a href="#" class="editpublisher icon-green" id="'+data.ebook.publisher[i].pub_id+'"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></a></span>';
		
		if((flag == 0) || (flag == 1)){
			html += '<span data-toggle="tooltip" data-placement="top" title="'+title+'"><a href="#" class="deletepublisher icon-red '+color+'" id="'+data.ebook.publisher[i].pub_id+'"><span  aria-hidden="true" class="glyphicon glyphicon-ban-circle"></span></a></span>';   
			}              
                                
        html +='<span data-toggle="tooltip" data-placement="top" title="List Logs"><a href="#" class="link_show_log_publisher icon-yellow" id="'+data.ebook.publisher[i].pub_id+'"><span aria-hidden="true" class="fa fa-history"></span></a></span>';
        
        html += '</td>';
        html += '</tr>';

      }
       	$('#pubListTBody').append(html);
        $('[data-toggle="tooltip"]').tooltip();
  	}
  	else
  	{
		loading_flag=1;
		$('#loadingDiv').remove();
		if( $('#pubListTBody').is(':empty') ) 
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

	});
}

$('body').on('click','#create_pub',function(){
	$("#type_val").val(1);
	$("#create_pub_pop").modal('show');
	
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
				displayAlert("Alert Message", "Publisher successfully created.");
				$('#create_pub_pop').modal('hide');
			}
		else if(data.ebook.updated == 0)
			{
				$('#create_pub_pop').modal('hide');
				displayAlert("Alert Message", name_type+' already exits.');
			}	
	  });
	}
	else
	{
		$("#create_valErr").text("Please enter value.")
	}  
});

$('body').on('click','.editpublisher',function(){
	var pub_id = $(this).attr('id');
	$("#type_val").val(1);
	var val = $(this).closest('td').siblings('.pub_name').text();
	$("#edit_val").val(val);
	$("#id_val").val(pub_id);
	$("#old_pub_val").val(val);
	$("#edit_pub_pop").modal('show');
	
});

$('body').on('click','#yes_edit',function()
{
	var name_type = $("#edit_val").val().trim();
	logData = new Array();
	oldDataInfo = new Array();
	oldDataInfo["pub_name"] = $("#old_pub_val").val();
	data_old = {
          "pub_name":escapeHtml(oldDataInfo["pub_name"].trim()),       
        };           
                    
	data_new = {
          "pub_name":escapeHtml($("#edit_val").val().trim()),      
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
	if(name_type!='' && name_type!=null && logData!="")
	{
	run_waitMe(current_effect);// start the loader
	$.ajax({
	    url: "book_class.php",
	    type: 'POST',//method type
	    dataType:'text',
	    cache: false,//do not allow requested page to be cached
	    data: {ajaxcall : true,function2call: 'editAttributes',running_id : $("#id_val").val(), type_val : $("#type_val").val(),name_type : name_type,log_data:logData}
	  }).done(function(data)
	  {
		data = JSON.parse(data);
		$('body').waitMe('hide');
		if(data.ebook.updated == true)
			{
				displayAlert("Alert Message", "Publisher successfully updated.");
				$('#edit_pub_pop').modal('hide');
			}
	  });
	}
	else
	{
		$("#edit_valErr").text("Please enter value.")
	}  
});

$('body').on("click",".link_show_log_publisher", function()
	{
		var pub_id = $(this).attr('id');
		logLabels = new Array();
		logLabels["pub_name"] = "Publisher Name";
		logLabels["catStatus"] = "Status";
		page_scroll_position = $(window).scrollTop(); // get page scroll position 
		run_waitMe(current_effect);// start the loader
		$.ajax({
		    url: "book_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    data: {ajaxcall : true,function2call: 'getPublisherLog',pub_id:pub_id}
		  }).done(function(data)
		  {
			$('body').waitMe('hide');
			$('#logAgr').modal('show');
			html = buildLogModal(data);
			$('#userLogTBodyCus').html(html);
		   
		  });
	});

$('body').on('click', '.deletepublisher', function(e)
{
	e.preventDefault();
	$('.error-display').text('').hide();
	page_scroll_position = $(window).scrollTop(); // get page scroll position 
	var prf_id = $(this).attr('id');
	var profileName = $(this).closest('td').siblings('.pub_name').text();

	if($(this).hasClass( "red" ))
	{
	  $('#actPrfId').val(prf_id);
	  $('#actProfileName').val(profileName);
	  $('#profile_act_text').html('Are you sure you want to activate <b>' +profileName+ '</b> Publisher?');
	  $('#activate').modal('show');

	}
	else
	{
	  $('#deactPrfId').val(prf_id);
	  $('#deactProfileName').val(profileName);
	  $('#profile_deact_text').html('Are you sure you want to deactivate <b>' +profileName+ '</b> Publisher?');
	  $('#deacticate').modal('show');
	}
});

$('body').on("click",'#yes_ac', function(e){
	run_waitMe(current_effect);
	$.ajax({
	type: 'POST',//method type
	cache: false,//do not allow requested page to be cache
	data: {ajaxcall : true,function2call: 'activatePublisher', pub_id : $("#actPrfId").val() },
	url: "book_class.php",
	}).done(function(data){
	data = JSON.parse(data);
	$('body').waitMe('hide');
	if(data.ebook.activate == true)
	{
		displayAlert("Alert Message", "Publisher successfully activated.");
		$('#activate').modal('hide');
	}
	}).fail(function(){

	});
});

$('body').on("click",'#yes_deac', function(e){
	run_waitMe(current_effect);
	$.ajax({
	type: 'POST',//method type
	cache: false,//do not allow requested page to be cache
	data: {ajaxcall : true,function2call: 'deactivatePublisher', pub_id : $("#deactPrfId").val()},
	url: "book_class.php",
	}).done(function(data){
	data = JSON.parse(data);
	$('body').waitMe('hide');
	if(data.ebook.deactivate == true)
	{
		displayAlert("Alert Message", "Publisher successfully deactivated.");
		$('#deacticate').modal('hide');
	}
	}).fail(function(){

	});
});

$('body').on('click','#confirm_ok',function(){
	offset = 0;
	$('#pubListTBody').html('');
	$('#current_record_count ').text('0');
	displayRecords(offset);
});


});
