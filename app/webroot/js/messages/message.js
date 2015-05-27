'use strict'
var base_url;
$(document).ready(function(){
	base_url = $('html').attr('base-url');
	declareRecipientData();
});

function declareRecipientData(){
	if($("select[name='to_id']").length!==0) {
		$("select[name='to_id']").select2({
			templateResult: formatState
		});
	}
}

function formatState(state){
	var value  = $(state.element).attr('value');
	var imgSrc = $(state.element).attr('img-src');
	var label  = $(state.element).html();
	
	if(imgSrc!='') {

	} else {
		imgSrc = 'default.jpg';
	}
	
	var $state = $(
				    '<span class="optionContainer clearfix"><div class="avatar pull-left" style="background:url('+ base_url + 'public/images/users/'+ imgSrc +') center; background-size:cover;"></div> <div class="pull-left">' + state.text + '</div></span>'
				);
	
 	return $state;
}