$(document).ready(function()
{

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
});
