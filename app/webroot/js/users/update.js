'use strict'
var base_url = $('html').attr("base-url");
$(document).ready(function(){
  base_url = $('html').attr("base-url");
	//check if the birthday field exists
	if($('#userBirthday').length!==0) {
		$('#userBirthday').datetimepicker(); //declare datetimepicker
		var time_now = moment(); //get date now
		$('#userBirthday').data("DateTimePicker").maxDate(time_now);
		$("#userBirthday").on("dp.change",function (e) {
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
                  	},
                    stringLength: {
                      min:5,
                      message:"Name must be, at least, 5 characters in length!"
                    },
                    stringLength: {
                      max:20,
                      message:"Name must be, at most, 20 characters in length!"
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
          	  		identical: {
          	  			field: 'cpassword',
          	  			message: 'Passwords must match!'
          	  		}
          		}
          	},
          	'cpassword':{
          		validators: {
          	  		identical: {
          	  			field: 'password',
          	  			message: 'Passwords must match!'
          	  		}
          		}
          	}
      	}
  	})
	.on("success.form.bv",function(e){
		//submit the form by default
		$(e.target).data('bootstrapValidator').defaultSubmit();
	});

});