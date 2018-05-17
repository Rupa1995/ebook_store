$(document).ready(function()
{

	var offset = 0;
	var busy = false;
	var count = 0;
	var loading_flag = 0
	var total_count_flag = 1;
	var current_effect = 'win8';

	$('#orderListTBody').html('');  
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
  $('#orderListTBody').html('');
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
	data: {ajaxcall : true,function2call: 'getOrderList', offset:offset,flag :flag , total_count_flag : total_count_flag},
	url: "book_class.php",
	}).done(function(data){
	$('#loadingDiv').remove();      
	html = '';
	busy = false;
	data = JSON.parse(data); 
	count = data.ebook.order.length;
	
	if(total_count_flag == 1){
	$('#total_records_count').text(data.ebook.orderCountList);
	}
	var current_count_text = $('#current_record_count ').text();
	var updated_current_count = parseInt(current_count_text) + count;
	$('#current_record_count').text(updated_current_count);
 	if(data.ebook.order.length > 0)
 	{                            
      No = 0;                     
      for(var i=0; i < count ; i++)
      {
      	
        html += '<tr>';
		html += '<td>';
		html += ++No+offset;
		html += '</td>';
                          
		html += '<td>';
		html += data.ebook.order[i].payment_id;
		html += '</td>';

		html += '<td>';
		html += data.ebook.order[i].userName;
		html += '</td>';

		html += '<td>';
		html += data.ebook.order[i].order_name;
		html += '</td>';

		html += '<td>';
		html += data.ebook.order[i].order_time;
		html += '</td>';

		html += '<td>';
		html += data.ebook.order[i].oder_amt;
		html += '</td>';


        html += '<td class="action">';                             
        html +='<span data-toggle="tooltip" data-placement="top" title="Order Details"><a href="#" class="link_show_log_order icon-blue" id="'+data.ebook.order[i].order_id+'"><span aria-hidden="true" class="fa fa-dashboard"></span></a></span>';
        html += '</td>';

        html += '</tr>';

      }
       	$('#orderListTBody').append(html);
        $('[data-toggle="tooltip"]').tooltip();
  	}
  	else
  	{
		loading_flag=1;
		$('#loadingDiv').remove();
		if( $('#orderListTBody').is(':empty') ) 
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

function precisionRound(number, precision) 
  {
    var factor = Math.pow(10, precision);
    return Math.round(number * factor) / factor;
  }

$('body').on("click",".link_show_log_order", function()
	{
		var order_id = $(this).attr('id');
		
		page_scroll_position = $(window).scrollTop(); // get page scroll position 
		run_waitMe(current_effect);// start the loader
		$.ajax({
		    url: "book_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    data: {ajaxcall : true,function2call: 'getOrder',order_id:order_id}
		  }).done(function(data)
		  {
			$('body').waitMe('hide');
			data = JSON.parse(data);
			var html = ihtml='';
			count = data.ebook.orderDetails.length; 
			if(data.ebook.orderDetails.length > 0)
		 	{  
				html += '<div style="width: 100%;">';
				html += '<h3><b>Delivery Address : </b></h3>';
				html += '<span style="font-size:14px;">'+data.ebook.orderDetails[0]['order_name']+'</span><br>';
				html += '<span style="font-size:14px;">'+data.ebook.orderDetails[0]['street1']+', '+data.ebook.orderDetails[0]['street2']+',</span>';
				html += '<span style="font-size:14px;">'+data.ebook.orderDetails[0]['city']+',</span><br>';
				html += '<span style="font-size:14px;">'+data.ebook.orderDetails[0]['state_name']+' - '+data.ebook.orderDetails[0]['zip']+'</span>';
				html += '</div>'; 
				var sum = 0;
		      for(var i=0; i < count ; i++)
		      {
					ihtml += '<tr>';
					
					ihtml += '<td>';
					ihtml +=   (i+1);
					ihtml += '</td>';
					  
					ihtml += '<td>';
					ihtml += data.ebook.orderDetails[i]['item_name'];
					ihtml += '</td>';

					ihtml += '<td>';
					ihtml += data.ebook.orderDetails[i]['item_price'];
					ihtml += '</td>';

		        	ihtml += '</tr>';

		        	sum = sum + parseInt(data.ebook.orderDetails[i]['item_price']);
		      }
		       	$('#userLogTBodyCus').append(html);
		       	$("#itemListBody").append(ihtml);
		       	$("#totalAmount").html('<b>Total Amount : </b>'+sum+'<br>');
		       	$("#tax").html('<b>Tax : </b>'+precisionRound(data.ebook.orderDetails[0]['oder_amt'] - sum,2)+'<br>');
		       	$("#netBalance").html('<b>Net Balance : </b>'+data.ebook.orderDetails[0]['oder_amt']+'<br>');
		        $('[data-toggle="tooltip"]').tooltip();
		        $('#logAgr').modal('show');
		  	}
		   
		  });
	});

$('body').on('click','#confirm_ok',function(){
	offset = 0;
	$('#orderListTBody').html('');
	$('#current_record_count ').text('0');
	displayRecords(offset);
});


});
