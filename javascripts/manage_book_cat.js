$(document).ready(function()
{

	var offset = 0;
	var busy = false;
	var count = 0;
	var temp = 0;
	var total_count_flag = 1;
	var current_effect = 'win8';

	$('#bookListTBody').html('');  
	$('#current_record_count ').text('0');      
	displayRecords(offset);

$('#backid').on("click", function(){      
 window.location.href = "home.php";
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
	data: {ajaxcall : true,function2call: 'getBookCatList', offset:offset,flag :flag , total_count_flag : total_count_flag},
	url: "book_class.php",
	}).done(function(data){
	$('#loadingDiv').remove();      
	html = '';
	busy = false;
	data = JSON.parse(data); 
	count = data.ebook.book_cat.length;
	
	if(total_count_flag == 1){
	$('#total_records_count').text(data.ebook.bookcatCountList);
	}
	var current_count_text = $('#current_record_count ').text();
	var updated_current_count = parseInt(current_count_text) + count;
	$('#current_record_count').text(updated_current_count);
 	if(data.ebook.book_cat.length > 0)
 	{                            
      No = 0;                     
      for(var i=0; i < count ; i++)
      {
      	
        html += '<tr>';
		html += '<td>';
		html += ++No+offset;
		html += '</td>';
                          
		html += '<td>';
		html += data.ebook.book_cat[i].cat_name;
		html += '</td>';
                      
        html += '<td class="action">';
                      
        if((flag == 0) || (flag == 1)){
         html += '<span data-toggle="tooltip" data-placement="top" ><a href="#" class="deleteUser icon-red" id="'+data.ebook.book_cat[i].cat_id+'"><span  aria-hidden="true" class="glyphicon glyphicon-ban-circle"></span></a></span>';   
        }
                        
        html +='<span data-toggle="tooltip" data-placement="top" title="List Logs"><a href="#" class="link_show_log_user icon-yellow" id="'+data.ebook.book_cat[i].cat_id+'"><span aria-hidden="true" class="fa fa-history"></span></a></span>';
        
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
	}).fail(function(){

	});
}



});
