$(document).ready(function()
{
  var error_arr = new Array();
  var error_id;
<<<<<<< HEAD

=======
  var current_effect = 'win8';//windows 8  effect of loader 
  var d_state_id = 0;
  var userInfo;
  run_waitMe(current_effect);
>>>>>>> 07b422e805ef4794e80a390627f45686d38f37b5
  $.ajax({
    type: 'POST',
    cache: false,
    data: {ajaxcall : true,function2call: 'getUserDetails',user_id:user_id},
    url: "edit_profile_class.php",
  }).done(function(data){
    var obj = jQuery.parseJSON(data);
    var user_list = obj.ebook.user_info;
    userInfo = user_list;
    var country_list = obj.ebook.country_info;
    $('#upCountry').html($("<option></option>")
             .attr("value"," ")
             .text("Select")); 
    $("#upFirstName").val(user_list['fname']);
    $("#upLastName").val(user_list['lname']);
    $("#upStreet1").val(user_list['street1']);
    $("#upStreet2").val(user_list['street2']);
    $("#upContactNo").val(user_list['contact']);
    $("#upRegion").val(user_list['region']);
    $("#upCity").val(user_list['city']);
    $("#upZipCode").val(user_list['pincode'])
    for(var i = 0; i<country_list.length; i++)
    {
     $.each(country_list[i], function(key, value) {
      if(key == "id")
      {
        cid = value;
      } 
      if(key == 'name'){
        $('#upCountry')
         .append($("<option></option>")
                    .attr("value",cid)
                    .text(value)); 
       }
    });
    }

    $('#upCountry').val(user_list["country_id"]);
    $('#upCountry').trigger('change');
    $('#upCountry').selectpicker('refresh');
    d_state_id = user_list['state_id'];
    userInfo['country'] = $("#upCountry option[value='"+user_list["country_id"]+"']").text().trim();
    $('body').waitMe('hide');

  }).fail(function(){
    displayAlert("Alert Message", "Failed to fetch data.");
  });

  $("#upCountry").on('change',function(e)
  {
    var c_code = $(this).val();
    $('#upState').html($("<option></option>")
                 .attr("value"," ")
                 .text("Select")); 
    $.ajax({
    type: 'POST',
    cache: false,
    data: {ajaxcall : true,function2call: 'getStateList', c_code : c_code},
    url: "edit_profile_class.php",
    }).done(function(data){
      var obj = jQuery.parseJSON(data);
      var state_list = obj.ebook.state_info;
      for(var j =0;j<state_list.length;j++)
      {
        $.each(state_list[j], function(key, value) {
        if(key == "id")
        {
          sid = value;
        } 
        if(key == 'name'){
          $('#upState')
           .append($("<option></option>")
                      .attr("value",sid)
                      .text(value)); 
         }
      });
      }
      if(d_state_id!=0)
      {
        $("#upState").val(d_state_id);
      }
      $('#upState').selectpicker('refresh');
      userInfo['state'] = $("#upState option[value='"+userInfo['state_id']+"']").text().trim();
    }).fail(function(){

    });
  }); 

  
$("#edit_profile_pop").modal('show');


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

/* Function For User ContactNo Validation */
function userContactNoValidation(input_field,err_field,mandatory){  
  
  var val=1;
  var contactno = $(input_field).val();
  if( contactno == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter contact number.").show();
  }else{
    var yourInput = contactno;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;)").show();
    }

  }
  return val; 

}

/* Function for Password validation */
function passwordValidation(input_field,err_field,mandatory){

  var val = 1;
  var yourInput = $(input_field).val(); 
  if( yourInput == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter the password.").show();
  }else{
    
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;
}

/* Function for street1 validation */
function street1Validation(input_field,err_field,mandatory){
  var val=1;
  var street1 = $(input_field).val();
  if( street1 == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter street 1 name.").show();
  }else{
    var yourInput = street1;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;
}

/* Function for street2 validation */
function street2Validation(input_field,err_field,mandatory){
  
  var val=1;
  var street2 = $(input_field).val();
  if( street2 == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter street 2 name.").show();
  }else{
    var yourInput = street2;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;
}

/* Function for  Area validation */
function areaValidation(input_field,err_field,mandatory){
  var val=1;
  var area = $(input_field).val();
  if( area == '' && mandatory == 1){
    val = 0;
    $(err_field).html(Lang['area_emp_name']).show();
  }else{
    var yourInput = area;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html(Lang['area_chk_name']).show();
    }

  }
  return val;
}

/* Function for  city validation */
function cityValidation(input_field,err_field,mandatory){
  var val=1;
  var city = $(input_field).val();
  if( city == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter city name.").show();
  }else{
    var yourInput = city;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;
}

/* Function for State validation */
function stateValidation(input_field,err_field,mandatory){
 var val=1;
  var state = $(input_field).val();
  if( state == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter state name.").show();
  }else{
    var yourInput = state;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;

}

/* Function for Country validation */
function countryValidation(input_field,err_field,mandatory){
  var val=1;
  if($(input_field).val() == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please select atleast one country").show();
  }
  return val;
}

/* Function for  Zip code validation */
function zipcodeValidation(input_field,err_field,mandatory){ 
  var val=1;
  var zipcode = $(input_field).val();
  if( zipcode == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter zip code.").show();
  }else{
    var yourInput = zipcode;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;
}

function userEditValidation () {
    var valid = 1;
    $('.error-display').text('').hide();

    if(userFirstNameValidation('#upFirstName','.eFirstNameErr',1) == 0){
      valid = 0;
      error_arr.push("#upFirstName");
    }

    if(userLastNameValidation('#upLastName','.eLastNameErr',1) == 0){
      valid = 0;
      error_arr.push("#upLastName");
    }

    if(street1Validation('#upStreet1','.estreet1Err',1) == 0){
      valid = 0;
      error_arr.push("#upStreet1");
    }

    if(street2Validation('#upStreet2','.estreet2Err',0) == 0){
      valid = 0;
      error_arr.push("#upStreet2");
    }

    if(cityValidation('#upCity','.eCityErr',1) == 0){
      valid = 0;
      error_arr.push("#upCity");
    }

    if(stateValidation('#upState','.eStateErr1',1) == 0)
    {
      valid = 0;
      error_arr.push("#upState");
    }

    if(areaValidation('#upRegion','.upRegionErr',0) == 0){
      valid = 0;
      error_arr.push("#upRegion");
    }
    
    if(zipcodeValidation('#upZipCode','.eZipCodeErr',1) == 0){
      valid = 0;
      error_arr.push("#upZipCode");
    }

    if(userContactNoValidation('#upContactNo','.eContactNoErr',1) == 0){
      valid = 0;
      error_arr.push("#upContactNo");
    }

    error_id = error_arr[0];
    if(error_id == undefined)
     {
        console.log(error_id);
     }else
     {

     var erroroffset_top = parseInt($(error_id).offset().top);
    
    if($(error_id).hasClass("multiselect"))
    {
            $(error_id).parents(".dropDown_hover").find(".multiselect").focus();
           $(".modal-open .modal").css("overflow-y","auto");
           $(".modal").scrollTop(erroroffset_top);
           error_arr = [];
    }
    else
    {
        if(error_id == "#eAgrCustomer")
        {
        
          $(error_id).focus();
          $(".modal-open .modal").css("overflow-y","auto");
          $(".modal").scrollTop(erroroffset_top);
          error_arr = [];
        }
        else
        {
          var window_height = $(window).height();
          if(window_height >= parseInt(window_height)+erroroffset_top)
          {
            $(".modal-open .modal").css("overflow-y","hidden");
            $(".modal").scrollTop(erroroffset_top);
          }   
            $(error_id).focus();
            error_arr = [];
            $(".modal-open .modal").css("overflow-y","auto");
        }     
    }
  }

  return valid;  
  }

$('#updateUserForm').submit(function(e){
  e.preventDefault();
  page_scroll_position = $(window).scrollTop(); // get page scroll position 
  var valid = userEditValidation();
      var first_tym_flag = userInfo['first_tym_flag'];
      logData = new Array();
      if(first_tym_flag==2)
      {
        data_old = {
                  "userFirstName":userInfo["fname"].trim(),
                  "lastName":userInfo["lname"].trim(),
                  "street1":userInfo["street1"].trim(),
                  "street2":userInfo["street2"].trim(),
                  "area":userInfo["region"].trim(),
                  "city":userInfo["city"].trim(),
                  "state":userInfo["state"].trim(),
                  "country":userInfo['country'],
                  "zipCode":userInfo["pincode"].trim(),
                  "mobile":userInfo["contact"].trim(),
                };           
                            
        data_new = {
                  "userFirstName":escapeHtml($("#upFirstName").val().trim()),
                  "lastName":escapeHtml($("#upLastName").val().trim()),
                  "street1":escapeHtml($("#upStreet1").val().trim()),
                  "street2":escapeHtml($("#upStreet2").val().trim()),
                  "area":escapeHtml($("#upRegion").val().trim()),
                  "city":escapeHtml($("#upCity").val().trim()),
                  "state":$("#upState option:selected").text().trim(),
                  "country":$("#upCountry option:selected").text().trim(),
                  "zipCode":escapeHtml($("#upZipCode").val().trim()),
                  "mobile":escapeHtml($("#upContactNo").val().trim()),      
                };
        
              log_data = filter(data_old, data_new),key;
              i = 0;
              for (key in log_data) {
                  if (log_data.hasOwnProperty(key)) {
                      logData[i++] = '"'+key+'":{"'+userInfo[key]+'":"'+log_data[key]+'"}';
                  }
              }
              if(logData.length > 0){
                  logData ="{"+logData.join(",")+"}";
              }
      }        
     if(valid == 1)
     {
        run_waitMe(current_effect);
        $.ajax({
          type: 'POST',
          cache: false,
          data: {
            ajaxcall : true,
            function2call: 'updateUser',
            user_id:user_id,
            fname:$("#upFirstName").val().trim(),
            lname:$("#upLastName").val().trim(),
            street1:$("#upStreet1").val().trim(),
            street2:$("#upStreet2").val().trim(),
            region:$("#upRegion").val().trim(),
            city:$("#upCity").val().trim(),
            country:$("#upCountry option:selected").val(),
            state:$("#upState option:selected").val(),
            zip:$("#upZipCode").val().trim(),
            contact:$("#upContactNo").val().trim(),
            logData : logData
        },
          url: "edit_profile_class.php",
        }).done(function(data)
        {
            $('body').waitMe('hide');
            displayAlert("Alert Message", "You have successfully updated the <b>"+userInfo['uname']+"</b> user information.");
            $('#alert_value').val('updated');
        }).fail(function(){
          displayAlert("Alert Message", "Failed to Update.");
        });
     }
     else
     {
       displayAlert("Alert Message", "Nothing has been changed.");
     }       
});

$('.close, #cancel').click(function(){
  window.location.href = "index.php";
});

$("#confirm_ok").click(function(){
  value = $("#alert_value").val();
  if(value == 'updated')
  {
    if(userInfo['admin_flag']==1)
    {
      window.location.href = "./admin/home.php";
    }
    else
    {
      window.location.href = "index.php";  
    }
  }
  else
  {
    $("#alertModal").modal('hide');
  }
});

<<<<<<< HEAD
$('.upresetprofilePic').on('click', function(e)
{
	e.preventDefault();
	$("#upProfilePic_filename").text("No file selected.");
	$('#upProfilePic').attr('title' ,'No file selected');
	$('#eProfilePicErr').hide();
	$('#upProfilePic').val('');
	$('#upProfilePic').attr('title' ,'');
	$('#upProfilePic_check').val(1);
	$('input[type=file]').val('');
});	
	$("#edit_profile_pop").modal('show');


function userEditValidation () {
    var valid = 1;
    $('.error-display').text('').hide();

    if(userFirstNameValidation('#upFirstName','.eFirstNameErr',1) == 0){
      valid = 0;
      error_arr.push("#upFirstName");
    }

    if(userLastNameValidation('#upLastName','.eLastNameErr',1) == 0){
      valid = 0;
      error_arr.push("#upLastName");
    }

    if(street1Validation('#upStreet1','.estreet1Err',1) == 0){
      valid = 0;
      error_arr.push("#upStreet1");
    }

    if(street2Validation('#upStreet2','.estreet2Err',0) == 0){
      valid = 0;
      error_arr.push("#upStreet2");
    }

    if(cityValidation('#upCity','.eCityErr',1) == 0){
      valid = 0;
      error_arr.push("#upCity");
    }

    if(stateValidation('#upState1','.eStateErr1',1) == 0)
    {
      valid = 0;
      error_arr.push("#upState1");
    }

    if(areaValidation('#upRegion','.upRegionErr',0) == 0){
      valid = 0;
      error_arr.push("#upRegion");
    }

    if(zipcodeValidation('#upZipCode','.eZipCodeErr',1) == 0){
      valid = 0;
      error_arr.push("#upZipCode");
    }

    if(userContactNoValidation('#upContactNo','.eContactNoErr',0) == 0){
      valid = 0;
      error_arr.push("#upContactNo");
    }

    var file = new Boolean($("form input[type=file]").val());
    if(file == true){
      
      var fsize = $('input:file')[0].files[0].size/1024 ;
      var ftype = $('input:file')[0].files[0].type;
      ftype = ftype.split('/');
      if (ftype[1] !="png" && ftype[1] !="jpg" && ftype[1] !="jpeg"){
        
          valid = 0;
          $('.eProfilePicErr').text('Please upload only png, jpg and jpeg images.').show();
      }else if(fsize > 1000){
        valid = 0;
        $('.eProfilePicErr').text('Please limit image size to 1MB.').show();
      }
    }
   
      error_id = error_arr[0];
      if(error_id == undefined)
       {
          console.log(error_id);
       }else
       {

       var erroroffset_top = parseInt($(error_id).offset().top);
    
    if($(error_id).hasClass("multiselect"))
    {
            $(error_id).parents(".dropDown_hover").find(".multiselect").focus();
           $(".modal-open .modal").css("overflow-y","auto");
           $(".modal").scrollTop(erroroffset_top);
           error_arr = [];
    }
    else
    {
        if(error_id == "#eAgrCustomer")
        {
        
          $(error_id).focus();
          $(".modal-open .modal").css("overflow-y","auto");
          $(".modal").scrollTop(erroroffset_top);
          error_arr = [];
        }
        else
        {
          var window_height = $(window).height();
          if(window_height >= parseInt(window_height)+erroroffset_top)
          {
            $(".modal-open .modal").css("overflow-y","hidden");
            $(".modal").scrollTop(erroroffset_top);
          }   
            $(error_id).focus();
            error_arr = [];
            $(".modal-open .modal").css("overflow-y","auto");
        }     
    }
  }

  return valid;  
  }

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

/* Function For User ContactNo Validation */
function userContactNoValidation(input_field,err_field,mandatory){  
  
  var val=1;
  var contactno = $(input_field).val();
  if( contactno == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter contact number.").show();
  }else{
    var yourInput = contactno;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;)").show();
    }

  }
  return val; 

}

/* Function for Password validation */
function passwordValidation(input_field,err_field,mandatory){

  var val = 1;
  var yourInput = $(input_field).val(); 
  if( yourInput == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter the password.").show();
  }else{
    
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;
}

/* Function for street1 validation */
function street1Validation(input_field,err_field,mandatory){
  var val=1;
  var street1 = $(input_field).val();
  if( street1 == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter street 1 name.").show();
  }else{
    var yourInput = street1;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;
}

/* Function for street2 validation */
function street2Validation(input_field,err_field,mandatory){
  
  var val=1;
  var street2 = $(input_field).val();
  if( street2 == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter street 2 name.").show();
  }else{
    var yourInput = street2;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;
}

/* Function for  city validation */
function cityValidation(input_field,err_field,mandatory){
  var val=1;
  var city = $(input_field).val();
  if( city == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter city name.").show();
  }else{
    var yourInput = city;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;
}

/* Function for State validation */
function stateValidation(input_field,err_field,mandatory){
 var val=1;
  var state = $(input_field).val();
  if( state == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter state name.").show();
  }else{
    var yourInput = state;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;

}

/* Function for Country validation */
function countryValidation(input_field,err_field,mandatory){
  var val=1;
  if($(input_field).val() == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please select atleast one country").show();
  }
  return val;
}

/* Function for  Zip code validation */
function zipcodeValidation(input_field,err_field,mandatory){ 
  var val=1;
  var zipcode = $(input_field).val();
  if( zipcode == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter zip code.").show();
  }else{
    var yourInput = zipcode;
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;).").show();
    }

  }
  return val;
}

$('#updateUserForm').submit(function(e){
  e.preventDefault();
  page_scroll_position = $(window).scrollTop(); // get page scroll position 
  var valid = userEditValidation();
  alert(valid)
});


=======
>>>>>>> 07b422e805ef4794e80a390627f45686d38f37b5
});