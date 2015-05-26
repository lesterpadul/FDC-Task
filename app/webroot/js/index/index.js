var base_url;
$(document).ready(function(){

	base_url = $('html').attr('base-url');

	$('.form').find('input, textarea').on('keyup blur focus', function (e) {
	  
	  var $this = $(this),
	      label = $this.prev('label');

		if (e.type === 'keyup') {
				if ($this.val() === '') {
	          label.removeClass('active highlight');
	        } else {
	          label.addClass('active highlight');
	        }
	    } else if (e.type === 'blur') {
	    	if( $this.val() === '' ) {
	    		label.removeClass('active highlight'); 
				} else {
			    label.removeClass('highlight');   
				}   
	    } else if (e.type === 'focus') {
	    
	    if( $this.val() === '' ) {
	    		label.removeClass('highlight'); 
				} 
	      else if( $this.val() !== '' ) {
			    label.addClass('highlight');
				}
	    }

	});

	$('.tab a').on('click', function (e) {
	  
	  e.preventDefault();
	  
	  $(this).parent().addClass('active');
	  $(this).parent().siblings().removeClass('active');
	  
	  target = $(this).attr('href');

	  $('.tab-content > div').not(target).hide();
	  
	  $(target).fadeIn(600);
	  
	});
});


/**
 * [LOGIN_USER description]
 * @param {[type]} obj [description]
 */
function LOGIN_USER(obj){
	var ser    = $('#UserLoginForm').serialize();
	var action = $('#UserLoginForm').attr('action');

	$(obj).attr('disabled','disabled');

	//validate the field here	
	$.post(base_url+action,ser,function(data){
		console.log(data);
		if(!data.error){
			window.location.href=base_url+'home/index';
		}else{
			SET_LABEL('Incorrect Details','alert-danger');
		}
		$(obj).removeAttr('disabled');
	},'json').fail(function(x){
		$(obj).removeAttr('disabled');
		console.log(x.responseText);
	})
}

/**
 * [SET_LABEL description]
 * @param {[type]} $content [description]
 * @param {[type]} $type    [description]
 * @param {[type]} $hide    [description]
 */
function SET_LABEL($content,$type,$hide){
	if($hide){
		$("#alertContainerIndex").hide();
	}else{
		$("#alertContainerIndex")
		.attr('class','alert')
		.html($content)
		.addClass($type)
		.show();
	}
}