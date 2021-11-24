jQuery(function($) {
	$('#contactform').validate({
		rules: {
			name: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			message: {
				required: true,
			}
		},
		messages: {
			name: {
				required: "Please enter your name",
				minlength: "Your name must consist of at least 2 characters"
			},
			email: {
				required: "Please enter your email"
			},
			message: {
				required: "Please enter your message"
			}
		},
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				type:"POST",
				data: $(form).serialize(),
				url:"external/form/contact-form.php",
				success: function() {
					  $('#success').fadeIn();
			$( '#contactform' ).each(function(){this.reset();});
				},
				error: function() {
					$('#contactform').fadeTo( "slow", 1, function() {
						$('#error').fadeIn();
					});
				}
			});
		}
	});
	//footer
	$('#newsletterform-01').validate({
		rules: {
			email: {
				required: true,
				email: true
			}
		},
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				type:"POST",
				data: $(form).serialize(),
				url:"external/form/newsletter-form.php",
				success: function() {
					  $('#success').fadeIn();
			$('#newsletterform-01').each(function(){this.reset();});
				},
				error: function() {
					$('#newsletterform-01').fadeTo( "slow", 1, function() {
						$('#error').fadeIn();
					});
				}
			});
		}
	});
	// Blog, aside
	$('#newsletterform-02').validate({
		rules: {
			email: {
				required: true,
				email: true
			}
		},
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				type:"POST",
				data: $(form).serialize(),
				url:"external/form/newsletter-form.php",
				success: function() {
					  $('#success').fadeIn();
			$('#newsletterform-02').each(function(){this.reset();});
				},
				error: function() {
					$('#newsletterform-02').fadeTo( "slow", 1, function() {
						$('#error').fadeIn();
					});
				}
			});
		}
	});
	//modal Discount
	$('#newsletterform-03').validate({
		rules: {
			email: {
				required: true,
				email: true
			}
		},
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				type:"POST",
				data: $(form).serialize(),
				url:"external/form/newsletter-form.php",
				success: function() {
					  $('#success').fadeIn();
			$('#newsletterform-03').each(function(){this.reset();});
				},
				error: function() {
					$('#newsletterform-03').fadeTo( "slow", 1, function() {
						$('#error').fadeIn();
					});
				}
			});
		}
	});
	//page maintence.html
	$('#newsletterform-04').validate({
		rules: {
			email: {
				required: true,
				email: true
			}
		},
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				type:"POST",
				data: $(form).serialize(),
				url:"external/form/newsletter-form.php",
				success: function() {
					  $('#success').fadeIn();
			$('#newsletterform-04').each(function(){this.reset();});
				},
				error: function() {
					$('#newsletterform-04').fadeTo( "slow", 1, function() {
						$('#error').fadeIn();
					});
				}
			});
		}
	});
});