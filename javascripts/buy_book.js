$(document).ready(function()
{
	$('[data-toggle="tooltip"]').tooltip(); 
	var current_effect = 'win8';
	$('body').on('click','.btn-cart',function(){
		var book_id = $(this).attr('id');
		run_waitMe(current_effect);// start the loader
		$.ajax({
		    url: "book_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    data: {ajaxcall : true,function2call: 'addToCart',book_id:book_id}
		  }).done(function(data)
		  {
			data = JSON.parse(data);
			$('body').waitMe('hide');
			if(data.ebook.inserted == true)
			{
				displayAlert("Alert Message", "Successfully Added.");
			}
			else if(data.ebook.inserted == 0)
			{
				displayAlert("Alert Message", "Already exists in chart.");
			}
			else
			{
				displayAlert("Alert Message", "Failed to Add.");
			}   
		  });
	});

	$('body').on('click','.btn-wish',function(){
		var book_id = $(this).attr('id');
		run_waitMe(current_effect);// start the loader
		$.ajax({
		    url: "book_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    data: {ajaxcall : true,function2call: 'addToWish',book_id:book_id}
		  }).done(function(data)
		  {
			data = JSON.parse(data);
			$('body').waitMe('hide');
			if(data.ebook.inserted == true)
			{
				displayAlert("Alert Message", "Successfully Added.");
			}
			else if(data.ebook.inserted == 0)
			{
				displayAlert("Alert Message", "Already exists in Whislist.");
			}
			else
			{
				displayAlert("Alert Message", "Failed to Add.");
			}    
		  });
	});

	function displayRecord()
	{
		$.ajax({
		    url: "book_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    data: {ajaxcall : true,function2call: 'getAllBook'}
		  }).done(function(data)
		  {
			data = JSON.parse(data);
			$('body').waitMe('hide');
			if(data.ebook.success == true)
			{
				location.reload();
			}
			
		  });
	}
});	