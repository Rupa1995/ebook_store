
//function to display loader
function run_waitMe(effect){ //function for loader
$('body').waitMe({
  effect: effect,
  text: 'Please wait...',
  bg: 'rgba(255,255,255,.6)',
  color:'#636363',
  sizeW:'',
  sizeH:'',
  source: 'includes/img.svg'
});
}

$(document).ready(function(){
   $(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
      $('.scrollToTop').fadeIn();
    } else {
      $('.scrollToTop').fadeOut(10);
    }
  });
  $('.scrollToTop').click(function(){
    $('html, body').animate({scrollTop : 0},800);
    return false;
  });
 
});

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

  /*
    function to display alert message
  */
function displayAlert(alert_title, alert_body){
  $('#alertTitle').html(alert_title);
  $('#alertBody').html(alert_body);
  $('#alertModal').modal('show');

}

function escapeHtml(text) {
  return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "\'");
}

function filter(obj1, obj2) {
  var result = {};
  for(key in obj1) {
      if(obj2[key] != obj1[key]) result[key] = obj2[key];
      if(typeof obj2[key] == 'array' && typeof obj1[key] == 'array') 
          result[key] = arguments.callee(obj1[key], obj2[key]);
      if(typeof obj2[key] == 'object' && typeof obj1[key] == 'object') 
          result[key] = arguments.callee(obj1[key], obj2[key]);
  }
  return result;
}

function escapeNewLineChars(valueToEscape) {
if (valueToEscape != null && valueToEscape != "") {
    return valueToEscape.replace(/\n/g, "\\n");
} else {
    return valueToEscape;
}
}	

 function capitalizeFirstLetter(string) 
 {
    return string.charAt(0).toUpperCase() + string.slice(1);
 }

function buildLogModal(data){

    data = JSON.parse(data);
    var html = '';
    count = data.ebook.logList.length;          
    if(count > 0){
        for(i = 0; i < count; i++){
            
            html += '<div style="padding-bottom:5%;">';
            html += '<b>'+data.ebook.logList[i].userName+ '</b> updated '+ '( <b> '+ data.ebook.logList[i].modified_time +' </b> )';
            html += '<br>';             
            log = data.ebook.logList[i].log_data;
            log = escapeNewLineChars(log);
            log = JSON.parse(log);

              for (key in log) {
                  if (log.hasOwnProperty(key)) {                       
                     label = key;

                    if((label == 'bean_added') || (label == 'bean_remove') || (label == 'bean_update'))
                    {
                      value = log[key];
                     for (key in value){
                       if (value.hasOwnProperty(key)) {

                           value1 = (key == "" || key =="00/00/0000") ? "Empty" : key;
                           value2 = (value[key] == "" || value[key]== "00/00/0000") ? "Empty" : value[key]; 
                          value1 = value1.split("From").join("</b><span style='font-style: italic;'>From</span><b>")
                          value1 = value1.split("To").join("</b><span style='font-style: italic;'>To</span><b>")

                           html += '<span style="font-style: italic;">'+logLabels[label]+'</span> : ' + '<b> "' + value1 + '"</b>';
                           html += '<br>';
                       }
                     }
                    }
                    else
                    {
                     value = log[key];
                     for (key in value){
                       if (value.hasOwnProperty(key)) {

                           value1 = (key == "" || key =="00/00/0000") ? "Empty" : key;
                           value2 = (value[key] == "" || value[key]== "00/00/0000") ? "Empty" : value[key];
                           html += '<span style="font-style: italic;">'+logLabels[label]+'</span> : ' + '<b style="color:#fd3f41";> From </b><b style="overflow-wrap: break-word;"> "' + value1 + '"</b><b style="color:#fd3f41";> To </b> <b style="overflow-wrap: break-word;">"'+ value2+'"</b>';
                           html += '<br>';
                       }
                     }
                    }
                    

                  }
              }
      html += '</div>';
    }        
  }
  else{
      var html = '';
      html += '<p> <b>No Logs Available.</b> </p>';            
  }
 return html;
}