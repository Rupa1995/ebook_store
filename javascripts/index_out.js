function passwordValidation(input_field,err_field,mandatory){

  var val = 1;
  var yourInput = $(input_field).val(); 
  if( yourInput == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter New Password.").show();
  }else{
    
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
function confirmPasswordValidation(input_field,err_field,mandatory){

  var val = 1;
  var yourInput = $(input_field).val(); 
  if( yourInput == '' && mandatory == 1){
    val = 0;
    $(err_field).html("Please enter confrim Password.").show();
  }else{
    
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

function finalpasswordValidation()
{
    var valid = 1;
    if(passwordValidation('#pwd','#pwdErr',1) == 0){
      valid = 0;
    }

    if(confirmPasswordValidation('#cnfpwd','#cnfpwdErr',1) == 0){
      valid = 0;
    }

    var pwd = $('#pwd').val();
    var cnfpwd = $('#cnfpwd').val();

    if(pwd != '' && cnfpwd != ''){

      if(pwd != cnfpwd){
        valid = 0;
        $('.cnfpwdErr').text('The passwords you entered do not match.').show();
      }
    }
    return valid;
}

if(first_tym_flag==0)
{
  $('#change_pass_pop').modal('show');
  $('body').on("click","#change_pass",function(e){
    var valid = finalpasswordValidation();
    if(valid == 1)
    {
      run_waitMe('win8');
      $.ajax({
      type: 'POST',//method type
      cache: false,//do not allow requested page to be cache
      data: {ajaxcall : true,function2call: 'changePassword', user_id : login_uid, pass : $('#cnfpwd').val()},
      url: "edit_profile_class.php",
      }).done(function(data){
      data = JSON.parse(data);
      $('body').waitMe('hide');
      if(data.ebook.user_update==true)
      {
        displayAlert("Alert message","Password successfully changed, Click on OK to logout and login again.");        
      }
      }).fail(function(){
      });
    }
  });
}

$('body').on("click","#cancelPass, .close_pass, #changed_ok",function(e){
  window.location.href = 'logout.php';
});
