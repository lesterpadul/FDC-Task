!function(a){a.fn.equalHeights=function(){var b=0,c=a(this);return c.each(function(){var c=a(this).innerHeight();c>b&&(b=c)}),c.css("height",b)},a("[data-equal]").each(function(){var b=a(this),c=b.data("equal");b.find(c).equalHeights()})}(jQuery);    
jQuery(document).ready(function() {
	//Set up the Slider 
	if (jQuery(window).width() > 991 ) {
		setTimeout(function() {
			for (var i = 0; i < 15; i++) {
				//jQuery('#primary-home .row-'+i+' article').equalHeights();
				}
	      }, 1250);
	 }     				

	jQuery('.main-navigation .menu ul').superfish({
			delay:       1000,                            // 1 second avoids dropdown from suddenly disappearing
			animation:   {opacity:'show'},  			  // fade-in and slide-down animation
			speed:       'fast',                          // faster animation speed
			autoArrows:  false                            // disable generation of arrow mark-up
		});
	
	jQuery('.menu-toggle').toggle(function() {
		jQuery('#site-navigation ul.menu').slideDown();
		jQuery('#site-navigation div.menu').fadeIn();
	},
	function() {
		jQuery('#site-navigation ul.menu').hide();
		jQuery('#site-navigation div.menu').hide();
	});
		
	jQuery(window).bind('scroll', function(e) {
		hefct();
	});		
	
	if (jQuery(window).width() > 992 ) {
		       //  jQuery('#primary-home article').css( 'height', jQuery(this).parent('.row').height() ); 
		       //  jQuery('#primary-home article').css( 'height', jQuery(this).parent('.row').height() );
	}


	if(jQuery("#UPB_custom_modal").length!==0) {

		jQuery("#UPB_custom_modal")
		.off("hidden.bs.modal")
		.on("hidden.bs.modal",function(){

			jQuery("#UPB_custom_modal")
			.find('.loginContent').show();

			jQuery("#UPB_custom_modal")
			.find('.dynamicContent')
			.empty()
			.hide();

		}); 
		
	}
	
});
function hefct() {
	var scrollPosition = jQuery(window).scrollTop();
	jQuery('#parallax-bg').css('top', (0 - (scrollPosition * .2)) + 'px');
}	


function redirectURL(obj){
	var href = jQuery(obj).attr("data-href");
	
	jQuery
	.get(href,function(data){
		var content = jQuery(data).find("#UPB_custom_modal").find('.modal-body').html();

		jQuery("#UPB_custom_modal")
		.find('.loginContent').hide();

		jQuery("#UPB_custom_modal")
		.find('.dynamicContent')
		.empty()
		.append(content)
		.show()
		.find('#lostpasswordform')
		.attr("action",href);

	})
	.fail(function(x){
		
	});

	return false;
}

function catchPasswordChange(){
	var serializeData = jQuery('#lostpasswordform').serialize();
	var actionData = jQuery('#lostpasswordform').attr("action");

	jQuery.post(actionData,serializeData,function(res){

		alert("the password has been changed!");

		jQuery("#UPB_custom_modal")
		.modal("hide");

	}).fail(function(x){

	});

	return false;
}

function loginUser(){
	var formData   = jQuery('#loginform').serialize();
	var formAction = jQuery('#loginform').attr('action');
	$.post(
		formAction,
		formData,
		function(data){
			var content    = jQuery(data).find('form#loginform');
			var loginError = content.find('#loginErr');

			if(loginError.length!==0) {
				alert("error detected");
			} else {
				alert("No Error!");
			}
		}
	)
	.fail(function(){
		console.log("server error..");
	});
}