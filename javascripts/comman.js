
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

	
var log_flag = '';
function buildLogModal(data){
    data = JSON.parse(data);
    var html = '';
    count = data.media_portal.logList.length;          
    if(count > 0){
        for(i = 0; i < count; i++){
            log_flag = data.media_portal.logList[i].log_flag;  
            log = data.media_portal.logList[i].log_data;
            log = escapeNewLineChars(log);
            
          if(log_flag == 0){
            html += '<div style="padding-bottom:5%;">';
            html += '<b>'+data.media_portal.logList[i].userName+ '</b> updated '+ '( <b> '+ data.media_portal.logList[i].modified_time +' </b> )';
            html += '<br>';   
            log = JSON.parse(log);
              for (key in log) {
                if(log.hasOwnProperty(key)) {                       
                     label = key;
                     value = log[key];
                    if((label=='filterAdded' || label=='filterRemoved') && value!=''){
                      html += '<span style="font-style: italic;">'+logLabels[label]+'</span> : ' + '<b style="overflow-wrap: break-word;">"' + value + '"</b>';
                      html += '<br>';
                    }
                    else{
                        for (key in value){
                           if (value.hasOwnProperty(key)) {
                               value1 = (key == "" || key =="00/00/0000") ? "Empty" : key;
                               value2 = (value[key] == "" || value[key]== "00/00/0000") ? "Empty" : value[key];
                               html += '<span style="font-style: italic;">'+logLabels[label]+'</span> : ' + '<b style="color:#fd3f41;"> From </b><b style="overflow-wrap: break-word;">"' + value1 + '"</b><b style="color:#fd3f41;"> To </b><b style="overflow-wrap: break-word;"> "'+ value2+'"</b>';
                               html += '<br>';
                           }
                         }
                    }                         
                  }
              }
          }else{
            html += '<div style="padding-bottom:5%;">';
            html += 'created by <b>'+data.media_portal.logList[i].userName+ '</b> '+' ( <b> '+ data.media_portal.logList[i].modified_time +' </b> )';
            html += '<br>';   
             log = JSON.parse(log);
             key ="logNameCreated";
             label = key;
             value = log[key];
             html += '<span style="font-style: italic;">'+logLabels[label]+'</span> : ' + '<b> "' + value +'"</b>';
            html += '<br>';
          }
          html += '</div>';
        }        
      }
  else
  {
      var html = '';
      html += '<p> <b>No Logs Available.</b> </p>';            
  }
 return html;
}