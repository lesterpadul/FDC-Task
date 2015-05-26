'use strict'
var base_url;
$(document).ready(function(){
	base_url = $('html').attr('base-url');
	declareRecipientData();
});

function declareRecipientData(){
	if($("select[name='to']").length!==0) {
		$("select[name='to']").select2({
			//templateResult: formatState
		});
	}
}

function formatState(state){
	console.log(state);
	/*var $state = $(
				    '<span><img src="vendor/images/flags/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
				);*/
 	//return $state;
}