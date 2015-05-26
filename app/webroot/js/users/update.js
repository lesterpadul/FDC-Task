'use strict'
$(document).ready(function(){

	if($('#user_birthday').length!==0)
	{
		
		$('#user_birthday').datetimepicker();
		var time_now = moment();
		$('#user_birthday').data("DateTimePicker").maxDate(time_now);
		$("#user_birthday").on("dp.change",function (e) {
        	$("#UpdateUserForm").bootstrapValidator('revalidateField','birthday');
        });

	}

	//validate the addition of payments
	$("#UpdateUserForm").bootstrapValidator({
		excluded: [':disabled', ':hidden', ':not(:visible)'],
      	fields: {
          	'data[User][name]': {
              	validators: {
                  	notEmpty: {
                      	message: 'Name is required and cannot be empty'
                  	}
              	}
          	},
          	'birthday': {
          		validators: {
                  	notEmpty: {
                      	message: 'Birthday is required and cannot be empty'
                  	}
            	}
          	},
          	'hobby': {
          		validators: {
              		notEmpty: {
                  		message: 'Hobby is required and cannot be empty'
              		}
            	}
          	},
          	'data[User][email]':{
          		validators: {
          	  		notEmpty: {
          	  			message : "Email is required and cannot be empty"
          	  		},
          	  		emailAddress: {
          	  			message : "This must be a valid email address!"
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
		$(e.target).data('bootstrapValidator').defaultSubmit();
	});

});