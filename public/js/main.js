//input zone value for update (task)
function EditTask(id,foruser,tasktitle,task){
    $('#taskid').val(id);
    $('#floatingSelectEditTask').val(foruser);
    $('#taskTitleEdit').val(tasktitle);
    $('#TaskContentEdit').val(task);
}

window.$(document).ready(function(){
	"use strict";

    /*Start Sidebare Scripte*/
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

    /*Start change profile picture Scripte*/
	$( '.blacks , .Link_call_Modal_PDP' ).hover( function(){$('.Link_call_Modal_PDP').css("display","block");} );
	$( '.blacks , .Link_call_Modal_PDP' ).mouseout(function(){$('.Link_call_Modal_PDP').css("display","none");});
  /*End Sidebare Scripte*/






   });



