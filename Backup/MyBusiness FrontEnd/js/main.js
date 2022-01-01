(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {



		$('#sidebar').toggleClass('active');


  });



})(jQuery);


  $(document).ready(function(){

	$( '.blacks , .Link_call_Modal_PDP' ).hover( function(){$('.Link_call_Modal_PDP').css("display","block");} );
	//$('.Link_call_Modal_PDP').hover(function(){$('.Link_call_Modal_PDP').css("display","block");});
	$( '.blacks , .Link_call_Modal_PDP' ).mouseout(function(){$('.Link_call_Modal_PDP').css("display","none");});
	//$('.Link_call_Modal_PDP').mouseout(function(){$('.Link_call_Modal_PDP').css("display","none");});
	  /**Start Toas
    $('.toast').toast('show');
	$('.toast').toast({ autohide: false });
	/**End Toast */

	//$("#content").css("filter" , "blur(1.5rem)");

    });

