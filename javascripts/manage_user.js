$(document).ready(function()
{
	var offset = 0;
	var busy = false;
	var count = 0;
	var temp = 0;
	var total_count_flag = 1;
	var current_effect = 'win8';

	$('#userListTBody').html('');  
	$('#current_record_count ').text('0');      
	displayRecords(offset);

$('#backid').on("click", function(){      
 window.location.href = "home.php";
}); 

$(window).bind('scroll', function() {   
var v= $('#page-wrapper').offset().top + $('#page-wrapper').outerHeight() - window.innerHeight;
var intvalue = Math.floor( v );
if($(window).scrollTop() >= intvalue -10 && temp == 0 && !busy) {
 temp = 1;
 busy = true;             
 offset = 20 + offset; 
 displayRecords(offset);
}
});

$("#show_inactive").change(function () {
	$(this).prop('disabled',true).css('cursor','default');
  total_count_flag   = 1;
  $('#current_record_count ').text('0');
  offset = 0;        
  $('#userListTBody').html('');
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
	data: {ajaxcall : true,function2call: 'getUserList', offset:offset,flag :flag , total_count_flag : total_count_flag},
	url: "user_class.php",
	}).done(function(data){
	$('#loadingDiv').remove();      
	html = '';
	busy = false;
	data = JSON.parse(data); 
	count = data.ebook.user_info.length;

	if(total_count_flag == 1){
	$('#total_records_count').text(data.ebook.usersCountList);
	}
	var current_count_text = $('#current_record_count ').text();
	var updated_current_count = parseInt(current_count_text) + count;
	$('#current_record_count').text(updated_current_count);
 	if(data.ebook.user_info.length > 0)
 	{                            
      No = 0;                     
      for(var i=0; i < count ; i++)
      {
      	var admin_flag = data.ebook.user_info[i].admin_flag
      	if(data.ebook.user_info[i].user_isactive == '1')
      	{
			if($('#show_inactive').is(':disabled'))
			{
				$("#show_inactive").prop('disabled',false);
			}
 	    }	
        color = '';
        title = 'Deactivate';                     
        if(data.ebook.user_info[i].user_isactive == '0')
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
                          
		html += '<td>';
		html += data.ebook.user_info[i].user_fname;
		html += '</td>';
                      
		html += '<td>';
		html += data.ebook.user_info[i].user_lname;
		html += '</td>';

		html += '<td class="userName">';
		html += data.ebook.user_info[i].user_name;
		html += '</td>';

        html += '<td class="action">';
                      
        if((flag == 0 && admin_flag !=1) || (flag == 1 && admin_flag !=1)){
         html += '<span data-toggle="tooltip" data-placement="top" title="'+title+'"><a href="#" class="deleteUser icon-red '+color+'" id="'+data.ebook.user_info[i].user_id+'"><span  aria-hidden="true" class="glyphicon glyphicon-ban-circle"></span></a></span>';   
        }
                        
        html +='<span data-toggle="tooltip" data-placement="top" title="List Logs"><a href="#" class="link_show_log_user icon-yellow" id="'+data.ebook.user_info[i].user_id+'"><span aria-hidden="true" class="fa fa-history"></span></a></span>';
        
        html += '</td>';
        html += '</tr>';

      }
       	$('#userListTBody').append(html);
        $('[data-toggle="tooltip"]').tooltip();
  	}
  	else
  	{
		loading_flag=1;
		$('#loadingDiv').remove();
		if( $('#userListTBody').is(':empty') ) 
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

$('body').on("click",".link_show_log_user", function()
	{
		var user_id = $(this).attr('id');
		logLabels = new Array();
		logLabels['userFirstName'] = "First Name";
		logLabels['lastName'] = "Last Name";
		logLabels['street1'] = "Street Address 1";
		logLabels['street2'] = "Street Address 2";
		logLabels['area'] = "Region / Area";
		logLabels['city'] = "City";
		logLabels['state'] = "State";
		logLabels['country'] = "Country";
		logLabels['zipCode'] = "Postal / Zip code";
		logLabels['mobile'] = "Contact Number";
		logLabels['userStatus'] = "Status";

		page_scroll_position = $(window).scrollTop(); // get page scroll position 
		run_waitMe(current_effect);// start the loader
		$.ajax({
		    url: "user_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    data: {ajaxcall : true,function2call: 'getUserLog',user_id:user_id}
		  }).done(function(data)
		  {
			$('body').waitMe('hide');
			$('#logAgr').modal('show');
			html = buildLogModal(data);
			$('#userLogTBodyCus').html(html);
		   
		  });
	});

$('body').on('click', '.deleteUser', function(e)
{
	e.preventDefault();
	$('.error-display').text('').hide();
	page_scroll_position = $(window).scrollTop(); // get page scroll position 
	var prf_id = $(this).attr('id');
	var profileName = $(this).closest('td').siblings('.userName').text();

	if($(this).hasClass( "red" ))
	{
	  $('#actPrfId').val(prf_id);
	  $('#actProfileName').val(profileName);
	  $('#profile_act_text').html('Are you sure you want to activate <b>' +profileName+ '</b> user?');
	  $('#activate').modal('show');

	}
	else
	{
	  $('#deactPrfId').val(prf_id);
	  $('#deactProfileName').val(profileName);
	  $('#profile_deact_text').html('Are you sure you want to deactivate <b>' +profileName+ '</b> user?');
	  $('#deacticate').modal('show');
	}
});

$('body').on("click",'#yes_ac', function(e){
	run_waitMe(current_effect);
	$.ajax({
	type: 'POST',//method type
	cache: false,//do not allow requested page to be cache
	data: {ajaxcall : true,function2call: 'activateUser', user_id : $("#actPrfId").val() },
	url: "user_class.php",
	}).done(function(data){
	data = JSON.parse(data);
	$('body').waitMe('hide');
	if(data.ebook.activate == true)
	{
		$('#activate').modal('hide');
		displayRecords(offset);
	}
	}).fail(function(){

	});
});

$('body').on("click",'#yes_deac', function(e){
	run_waitMe(current_effect);
	$.ajax({
	type: 'POST',//method type
	cache: false,//do not allow requested page to be cache
	data: {ajaxcall : true,function2call: 'deactivateUser', user_id : $("#deactPrfId").val()},
	url: "user_class.php",
	}).done(function(data){
	data = JSON.parse(data);
	$('body').waitMe('hide');
	if(data.ebook.deactivate == true)
	{
		$('#deacticate').modal('hide');
		displayRecords(offset);
	}
	}).fail(function(){

	});
});


/* Function For User First Name Validation */
function userFirstNameValidation(input_field,err_field,mandatory){  
  var valid = 1;

  var myRegEx = /[|\\<>/]/gi;
  var isValid = !(myRegEx.test($(input_field).val()));
  var first_name = $(input_field).val();
  
  if(first_name == '' && mandatory ==1){
    valid = 0;
    $(err_field).text("Please enter the first name.").show();
  }else if((first_name != '') && (isValid == false)){
    valid = 0;
    $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;)").show();
  }

 return valid; 

}

/* Function For User Last Name Validation */
function userLastNameValidation(input_field,err_field,mandatory){  
  var valid = 1;

  var myRegEx = /[|\\<>/]/gi;
  var isValid = !(myRegEx.test($(input_field).val()));
  var last_name = $(input_field).val();
  
  if(last_name == '' && mandatory ==1){
    valid = 0;
    $(err_field).html("Please enter the last name.").show();
  }else if((last_name != '') && (isValid == false)){
    valid = 0;
    $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;)").show();
  }

 return valid; 

}

/* Function For User Email Validation */
function userEmailValidation(input_field,err_field,mandatory){  
  var valid = 1;

  var myRegEx = /^([a-zA-Z0-9\.\-\_\'])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;  
  var isValid = !(myRegEx.test($(input_field).val()));
  email_id = $(input_field).val(); 
  if(email_id != undefined){

    if(email_id == '' && mandatory ==1){
      valid = 0;
      $(err_field).html("Please enter the email address.").show();
    }else if((email_id != '') && (isValid == true)){
      
      valid = 0;
      $(err_field).html("Please enter the valid email address.").show();
    }
  
  }

  return valid; 

}

function createUserValidation()
{
	var valid = 1;
    $('.error-display').text('').hide();
    if(userFirstNameValidation('#upFirstName','.eFirstNameErr',1) == 0){
      valid = 0;
    }

    if(userLastNameValidation('#upLastName','.eLastNameErr',1) == 0){
      valid = 0;
    }

    if(userEmailValidation('#emailId','.emailErr',1) == 0){
      valid = 0;
    }

    return valid;
}

$('body').on("click","#createUser",function(e){
	$("#create_user_pop").modal('show');
});

$('body').on("click","#create_User",function(e){
	var valid = createUserValidation();
	if(valid==1)
	{
		run_waitMe(current_effect);
		$.ajax({
		type: 'POST',//method type
		cache: false,//do not allow requested page to be cache
		data: {
			ajaxcall : true,
			function2call: 'createUser',
			fname:$("#upFirstName").val().trim(),
            lname:$("#upLastName").val().trim(),
            emailId:$("#emailId").val().trim(),
            admin_flag:($("#internalUserFlag").is(":checked") == false) ? 0 : 1
        },
		url: "user_class.php",
		}).done(function(data){
		data = JSON.parse(data);
		$('body').waitMe('hide');
		if(data.valid== 0)
		{
			displayAlert("Alert Message", "User already exists.");
		}
		else
		{
			displayAlert("Alert Message", "User successfully created.");
			$("#create_user_pop").modal('hide');	
		}
		}).fail(function(){

		});
	}
});

});

