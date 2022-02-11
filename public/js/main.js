//input zone value for update (task)
function EditTask(id,foruser,tasktitle,task){
    $('#taskid').val(id);
    $('#floatingSelectEditTask').val(foruser);
    $('#taskTitleEdit').val(tasktitle);
    $('#TaskContentEdit').val(task);
}
//input zone value for update (Client)
function EditClient(id,firstname,lastname,phone,city,rating){
    $('#idEdit').val(id);
    $('#firstname').val(firstname);
    $('#lastname').val(lastname);
    $('#phone').val(phone);
    $('#city').val(city);
    $('#rating').val(rating);
}

//input zone value for update (Users)
function EditUser(id,name,firstname,username,email,phone,role,cin,approvement){
    $('#idEdit').val(id);
    $('#name').val(name);
    $('#firstname').val(firstname);
    $('#username').val(username);
    $('#email').val(email);
    $('#phone').val(phone);
    $('#role').val(role);
    $('#cin').val(cin);

    if(approvement == 1){ $('#approvement').prop('checked', true) }else if(approvement == 0){$('#approvement').prop('checked', false)};
}

//input zone valuefor update (LocalAds)
function EditLocalAds(id,content,startDate,endDate,status){

    $('#id_ed').val(id);
    $('#ad_content_ed').val(content);
    $('#start_date_ed').val(startDate);
    $('#end_date_ed').val(endDate);


    if(status == 1){ $('#status_ed').prop('checked', true) }else if(status == 0){$('#status_ed').prop('checked', false)};
}

// Move Remove link To Modal Message
function movedata(DeletedItem){
    $("#deleteForm").attr("action",DeletedItem);
}
function transferDataToModal(formId,root){
    $(formId).attr("action",root);
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



