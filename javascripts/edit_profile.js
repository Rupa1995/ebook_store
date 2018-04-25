$(document).ready(function()
{
  var error_arr = new Array();
  var error_id;

  $.ajax({
    type: 'POST',
    cache: false,
    data: {ajaxcall : true,function2call: 'getUserDetails',user_id:user_id},
    url: "edit_profile_class.php",
  }).done(function(data){
  	
  }).fail(function(){

  }); 


	$(function () {
    $("#editupload").bind("click", function () {
        //Get reference of FileUpload.
        var fileUpload = $("[name=upProfilePic]")[0]; 
        //Check whether the file is valid Image.
        if(fileUpload != ''){
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
            if (regex.test(fileUpload.value.toLowerCase())) {
                //Check whether HTML5 is supported.
                if (typeof (fileUpload.files) != "undefined") {
                    //Initiate the FileReader object.
                    var reader = new FileReader();
                    //Read the contents of Image File.
                    reader.readAsDataURL(fileUpload.files[0]);
                    reader.onload = function (e) {
                        //Initiate the JavaScript Image object.
                        var image = new Image();
                        //Set the Base64 string return from FileReader as source.
                        image.src = e.target.result;
                        image.onload = function () {
                            //Determine the Height and Width.
                            var height = this.height;
                            var width = this.width;
                            if (height > 300 || width > 300) {
                                $("#eProfilePicErr").text("Sorry, Image dimensions must not exceed 300px*300px.").show();                               
                                return false;
                            }
                        };
                    }
                } else {                 
                    return false;
                }
            }
         } else {
            $("#eProfilePicErr").text("Please select a valid Image file.").show();
            return false;
         }
    });
});

$('#upProfilePic').attr('title' ,'No file selected');
$("#upProfilePic_filename").text("No file selected.");

$('#upProfilePic').on('change', function()
{
  var upload_pic_name =$('#upProfilePic').val().replace(/C:\\fakepath\\/i, ''); 
  if(upload_pic_name == '')
  {
     $("#upProfilePic_filename").text("No file selected.");
  }
  else
  {
    $("#upProfilePic_filename").text(upload_pic_name);
    $("#upProfilePic").attr('title',upload_pic_name);
  }
});

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


});