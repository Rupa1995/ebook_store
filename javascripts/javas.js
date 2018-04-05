

//==================================== Nav ==================================================//
	 function openNav()
    {
      document.getElementById("mynav").style.width = "100%";
    }
    function closeNav() {
        document.getElementById("mynav").style.width = "0";
    }
// ==================================== Scroll to Top ===========================================//

$(window).scroll(function() {
	var height = $(this).scrollTop();
    if (height > 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$(document).ready(function() {
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 2000);
});
});
//====================================== Smooth Scrolling ========================================//
$(document).ready(function(){
    $("a").on('click', function(event) {
	   if (this.hash !== "") {
         event.preventDefault();
      		var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 2000, function(){
        window.location.hash = hash;
      });
    } 
  });
});
//====================================== ========================================//
