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
	
	//validate the addition of payments
	$("#RegisterUserForm").bootstrapValidator({
		excluded: [':disabled', ':hidden', ':not(:visible)'],
      	fields: {
          	'name_user': {
              	validators: {
                  	notEmpty: {
                      	message: 'Name is required and cannot be empty'
                  	},
                  	stringLength: {
                  		min:5,
                  		message:"Name must be, at least, 5 characters in length!"
                  	}
              	}
          	},
          	'email':{
          		validators: {
          	  		notEmpty: {
          	  			message : "Email is required and cannot be empty"
          	  		},
          	  		emailAddress: {
          	  			message : "This must be a valid email address!"
          	  		},
                  	remote: {
                    	message: "Email is already in use.",
                    	url:base_url+'messages/checkEmailExistence',
                    	type:"GET"
                  	}
          		}
          	},
          	'password':{
          		validators: {
          	  		notEmpty: {
          	  			message : "Password is required and cannot be empty"
          	  		},
          	  		identical: {
          	  			field: 'cpassword',
          	  			message: 'Passwords must match!'
          	  		}
          		}
          	},
          	'cpassword':{
          		validators: {
          	  		notEmpty: {
          	  			message : "Password is required and cannot be empty"
          	  		},
          	  		identical: {
          	  			field: 'password',
          	  			message: 'Passwords must match!'
          	  		}
          		}
          	}
      	}
  	})
	.on("success.form.bv",function(e){
		registerUser($('#register_user_btn'));
		return false;
	});

});


/**
 * [LOGIN_USER description]
 * @param {[type]} obj [description]
 */
function loginUser(obj){
	var ser    = $('#UserLoginForm').serialize();
	var action = $('#UserLoginForm').attr('action');

	$(obj).attr('disabled','disabled');

	//validate the field here	
	$.post(base_url+action,ser,function(data){
	
		if(!data.error){
			window.location.href=base_url+'messages/index';
		}else{
			setLabel('Incorrect Details','alert-danger');
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
function setLabel($content,$type,$hide){
	if($hide) {
		$("#alertContainerIndex").hide();
	} else {
		$("#alertContainerIndex")
		.attr('class','alert')
		.html($content)
		.addClass($type)
		.show();
	}
}

function registerUser(obj){
	var ser    = $('#RegisterUserForm').serialize();
	var action = $('#RegisterUserForm').attr('action');

	$(obj).attr('disabled','disabled');

	//validate the field here	
	$.post(action,ser,function(data){

		if(!data.error){
			window.location.href=base_url+'index/finalStep';
		}else{
			setLabel('Incorrect Details','alert-danger');
		}

		$(obj).removeAttr('disabled');
		
	},'json').fail(function(x){
		$(obj).removeAttr('disabled');
		console.log(x.responseText);
	});
}