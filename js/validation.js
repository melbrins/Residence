// FORM VALIDATION //////////////////////////////////////////////////////////////////


function resetForm() {
	$('form').find('input, textarea, select').each(function () { $(this).val(''); });
	$('.radio').removeClass('on').addClass('off');
}




// contact-us.php
/////////////////////////////////

$('#submit').click(function(e){  
	//stop the form from being submitted  
	e.preventDefault();
	
	$('.success, .pagecover, .loading').fadeIn(200); 

	var error = false;  

	var test = $('#firstname').val();	
	var name = $('#name').val();  
	var email = $('#email').val();  
	var message = $('#message').val();  
	var to = $('#To').val(); 


	if(test.length != 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#firstname').addClass("error");  
	}else{  
		$('#firstname').removeClass("error"); 
	}

	if(name.length == 0 || name.indexOf('</a>') == 0 || name.indexOf('http') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#name').addClass("error");  
	}else{  
		$('#name').removeClass("error");  
	}  
	
	if(email.length == 0 || email.indexOf('@') == '-1'){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#email').addClass("error");  
	}else{  
		$('#email').removeClass("error"); 
	}  
	
	if(message.length == 0 || message.indexOf('</a>') == 0 || message.indexOf('http') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#message').addClass("error"); 
	}else{  
		$('#message').removeClass("error");;  
	}  
	
	if(to.length == 0 ){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
	}

	if(error == false){  
		
		$.post("cms/email/traitement_contact.php", $("#email-form").serialize(),function(result){  
			if(result == 'sent'){ 
				$('.loading').fadeOut(100);
				$('.succeed').fadeIn(200);
				$('.success, .pagecover, .succeed').delay(2000).fadeOut(500); 
				resetForm();
				result == '';
			}else{ 
				$('#failed').fadeIn(500); 
			}  
		});  
	}  
});  


// arrange-view.php
/////////////////////////////////

$('#c2-submit').click(function(e){  
	//stop the form from being submitted  
	e.preventDefault();  
	$('.success, .pagecover, .loading').fadeIn(200); 
	
	var error = false;  
	
	var test = $('#name').val();
	var title = $('#title').val();
	var lastname = $('#lastname').val();
	var email = $('#email').val();
	var phone = $('#phone').val();
	var daytime = $('#daytime').val();
	var weektime = $('#weektime').val();
	var firstname = $('#firstname').val();
	var Further = $('#Further').val();
 
	
	if(test.length != 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#name').addClass("error");  
	}else{  
		$('#name').removeClass("error"); 
	}
	
    if(title.length == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#title').addClass("error");  
	}else{  
		$('#title').removeClass("error"); 
	}
		
	if(lastname.length == 0 || lastname.indexOf('http') == 0 || lastname.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#lastname').addClass("error");  
	}else{  
		$('#lastname').removeClass("error");  
	}  
	
	if(email.length == 0 || email.indexOf('@') == '-1'){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#email').addClass("error");  
	}else{  
		$('#email').removeClass("error"); 
	}  
	
	if(phone.length == 0 || phone.indexOf('http') == 0 || phone.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#phone').addClass("error"); 
	}else{  
		$('#phone').removeClass("error");;  
	}  
	
	if(daytime.length == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#daytime').addClass("error");  
	}else{  
		$('#daytime').removeClass("error"); 
	}
	
	if(weektime.length == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#weektime').addClass("error");  
	}else{  
		$('#weektime').removeClass("error"); 
	}

	if(firstname.indexOf('http') == 0 || firstname.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#firstname').addClass("error");  
	}else{  
		$('#firstname').removeClass("error"); 
	}
	
	if(Further.indexOf('http') == 0 || Further.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#Further').addClass("error");  
	}else{  
		$('#Further').removeClass("error"); 
	}


	if(error == false){  
		
		$.post("cms/email/traitement_view.php", $("#email-view").serialize(),function(result){  
			if(result == 'sent'){ 
				$('.loading').fadeOut(100);
				$('.succeed').fadeIn(200);
				$('.success, .pagecover, .succeed').delay(2000).fadeOut(500); 
				resetForm();
				result == '';
			}else{ 
				$('#failed').fadeIn(500); 
			}  
		});  
	} 
});  





// valuation.php
/////////////////////////////////

$('#v-submit').click(function(e){  
	//stop the form from being submitted  
	e.preventDefault();  
	$('.success, .pagecover, .loading').fadeIn(200); 
	
	var error = false;  
	
	var test = $('#name').val();
	var area_value = $('#area_value').val();
	var address_value = $('#address_value').val();
	var postcode_value = $('#postcode_value').val();
	var title = $('#title').val();
	var lastname = $('#lastname').val();
	var email = $('#email').val();
	var phone = $('#phone').val();
	var area_client = $('#area_client').val();
	var address_client = $('#address_client').val();
	var postcode_client = $('#postcode_client').val();
 	var Further = $('#Further').val();


 	if(test.length != 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#name').addClass("error");  
	}else{  
		$('#name').removeClass("error"); 
	}

 	if(area_value.length == 0 || area_value.indexOf('http') == 0 || area_value.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#area_value').addClass("error");  
	}else{  
		$('#area_value').removeClass("error"); 
	}

	if(address_value.length == 0 || address_value.indexOf('http') == 0 || address_value.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#address_value').addClass("error");  
	}else{  
		$('#address_value').removeClass("error"); 
	}
	
	if(postcode_value.length == 0 || postcode_value.indexOf('http') == 0 || postcode_value.indexOf('</a>') == 0){  
		var error = true; 
		$('.success, .pagecover, .loading').fadeOut(100);   
		$('#postcode_value').addClass("error");  
	}else{  
		$('#postcode_value').removeClass("error"); 
	}
	
	
    if(title.length == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#title').addClass("error");  
	}else{  
		$('#title').removeClass("error"); 
	}
		
	if(lastname.length == 0 || lastname.indexOf('http') == 0 || lastname.indexOf('</a>') == 0){  
		var error = true; 
		$('.success, .pagecover, .loading').fadeOut(100);   
		$('#lastname').addClass("error");  
	}else{  
		$('#lastname').removeClass("error");  
	}  
	
	if(email.length == 0 || email.indexOf('@') == '-1'){  
		var error = true; 
		$('.success, .pagecover, .loading').fadeOut(100);   
		$('#email').addClass("error");  
	}else{  
		$('#email').removeClass("error"); 
	}  
	
	if(phone.length == 0 || phone.indexOf('http') == 0 || phone.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#phone').addClass("error"); 
	}else{  
		$('#phone').removeClass("error");;  
	}  

	if(area_client.length == 0 || area_client.indexOf('http') == 0 || area_client.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#area_client').addClass("error");  
	}else{  
		$('#area_client').removeClass("error"); 
	}

	if(address_client.indexOf('http') == 0 || address_client.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#address_client').addClass("error");  
	}else{  
		$('#address_client').removeClass("error"); 
	}

	if(postcode_client.indexOf('http') == 0 || postcode_client.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#postcode_client').addClass("error");  
	}else{  
		$('#postcode_client').removeClass("error"); 
	}

	if(Further.indexOf('http') == 0 || Further.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#Further').addClass("error");  
	}else{  
		$('#Further').removeClass("error"); 
	}

	if(error == false){  
		
		$.post("cms/email/traitement_valuation.php", $("#email-valuation").serialize(),function(result){   
			if(result == 'sent'){ 
				$('.loading').fadeOut(100);
				$('.succeed').fadeIn(200);
				$('.success, .pagecover, .succeed').delay(2000).fadeOut(500); 
				resetForm();
				result == '';
			}else{ 
				$('#failed').fadeIn(500); 
			}  
		});  
	}
}); 





// acquisition.php
/////////////////////////////////

$('#a-submit').click(function(e){  
	//stop the form from being submitted  
	e.preventDefault(); 
	$('.success, .pagecover, .loading').fadeIn(200);  
	
	var error = false;  

	var test = $('#name').val();
	var title = $('#title').val();
	var lastname = $('#lastname').val();
	var email = $('#email').val();
	var phone = $('#phone').val();
	var budget = $('#budget').val();
	var area_client = $('#area_client').val();
	var area_property = $('#area_property').val();
	var bedroom = $('#bedroom').val();
	var type = $('#type').val();
	var address = $('#address').val();
	var postcode = $('#postcode').val();
	var Further = $('#Further').val();


	if(test.length != 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#name').addClass("error");  
	}else{  
		$('#name').removeClass("error"); 
	}
 
	if(title.length == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#title').addClass("error");  
	}else{  
		$('#title').removeClass("error"); 
	}
	
	if(lastname.length == 0 || lastname.indexOf('http') == 0 || lastname.indexOf('</a>') == 0){  
		var error = true; 
		$('.success, .pagecover, .loading').fadeOut(100);   
		$('#lastname').addClass("error");  
	}else{  
		$('#lastname').removeClass("error"); 
	}	
	
    if(phone.length == 0 || phone.indexOf('http') == 0 || phone.indexOf('</a>') == 0){  
		var error = true; 
		$('.success, .pagecover, .loading').fadeOut(100);   
		$('#phone').addClass("error");  
	}else{  
		$('#phone').removeClass("error"); 
	}
		
	if(budget.length == 0 || budget.indexOf('http') == 0 || budget.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#budget').addClass("error");  
	}else{  
		$('#budget').removeClass("error");  
	}  
	
	if(email.length == 0 || email.indexOf('@') == '-1'){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#email').addClass("error");  
	}else{  
		$('#email').removeClass("error"); 
	}  

	if(type.length == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#type').addClass("error"); 
	}else{  
		$('#type').removeClass("error");;  
	}  
	
	if(area_client.length == 0 || area_client.indexOf('http') == 0 || area_client.indexOf('</a>') == 0){  
		var error = true; 
		$('.success, .pagecover, .loading').fadeOut(100);   
		$('#area_client').addClass("error"); 
	}else{  
		$('#area_client').removeClass("error");;  
	}

	if(area_property.length == 0 || area_property.indexOf('http') == 0 || area_property.indexOf('</a>') == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#area_property').addClass("error"); 
	}else{  
		$('#area_property').removeClass("error");;  
	}   

	if(bedroom.length == 0){  
		var error = true; 
		$('.success, .pagecover, .loading').fadeOut(100);   
		$('#bedroom').addClass("error"); 
	}else{  
		$('#bedroom').removeClass("error");;  
	}  

	if(address.indexOf('http') == 0 || address.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#address').addClass("error");  
	}else{  
		$('#address').removeClass("error"); 
	}

	if(postcode.indexOf('http') == 0 || postcode.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#postcode').addClass("error");  
	}else{  
		$('#postcode').removeClass("error"); 
	}

	if(Further.indexOf('http') == 0 || Further.indexOf('</a>') == 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#Further').addClass("error");  
	}else{  
		$('#Further').removeClass("error"); 
	}


	if(error == false){  
		
		$.post("cms/email/traitement_acqui.php", $("#email-acqui").serialize(),function(result){    
			if(result == 'sent'){ 
				$('.loading').fadeOut(100);
				$('.succeed').fadeIn(200);
				$('.success, .pagecover, .succeed').delay(2000).fadeOut(500); 
				resetForm();
				result == '';
			}else{ 
				$('#failed').fadeIn(500); 
			}  
		});  
	}
}); 





// design studio.php
/////////////////////////////////

$('#ds-submit').click(function(e){  
	//stop the form from being submitted  
	e.preventDefault(); 

	$('.success, .pagecover, .loading').fadeIn(200); 

	var error = false;  

	var test = $('#name').val();
	var Home = $('#Home').val();
	var hope = $('#hope').val();
	var style = $('#style').val();
	var other = $('#other').val();
	var title = $('#title').val();
	var lastname = $('#lastname').val();
	var email = $('#email').val();
	var phone = $('#phone').val();
	var area = $('#area').val();
	var address = $('#address').val();
	var postcode = $('#postcode').val();


	if(test.length != 0){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#name').addClass("error");  
	}else{  
		$('#name').removeClass("error"); 
	}

 	if(Home.length == 0 || Home.indexOf('http') == 0 || Home.indexOf('</a>') == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#Home').addClass("error");  
	}else{  
		$('#Home').removeClass("error"); 
	}
	
	if(hope.length == 0 || hope.indexOf('http') == 0 || hope.indexOf('</a>') == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#hope').addClass("error");  
	}else{  
		$('#hope').removeClass("error"); 
	}
	
	
	if(style.length == 0 || style.indexOf('http') == 0 || style.indexOf('</a>') == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#style').addClass("error");  
	}else{  
		$('#style').removeClass("error"); 
	}

	if(other.length == 0 || other.indexOf('http') == 0 || other.indexOf('</a>') == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#other').addClass("error");  
	}else{  
		$('#other').removeClass("error"); 
	}
 	
 	if(title.length == 0){  
		var error = true; 
		$('.success, .pagecover, .loading').fadeOut(100);   
		$('#title').addClass("error");  
	}else{  
		$('#title').removeClass("error"); 
	}

	if(lastname.length == 0 || lastname.indexOf('http') == 0 || lastname.indexOf('</a>') == 0){  
		var error = true; 
		$('.success, .pagecover, .loading').fadeOut(100);   
		$('#lastname').addClass("error");  
	}else{  
		$('#lastname').removeClass("error"); 
	}

	if(email.length == 0 || email.indexOf('@') == '-1'){  
		var error = true;
		$('.success, .pagecover, .loading').fadeOut(100);    
		$('#email').addClass("error");  
	}else{  
		$('#email').removeClass("error"); 
	} 

	if(phone.length == 0 || phone.indexOf('http') == 0 || phone.indexOf('</a>') == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#phone').addClass("error");  
	}else{  
		$('#phone').removeClass("error"); 
	}

	if(area.length == 0 || area.indexOf('http') == 0 || area.indexOf('</a>') == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#area').addClass("error");  
	}else{  
		$('#area').removeClass("error"); 
	}

	if(address.length == 0 || address.indexOf('http') == 0 || address.indexOf('</a>') == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#address').addClass("error");  
	}else{  
		$('#address').removeClass("error"); 
	}
	
	if(postcode.length == 0 || postcode.indexOf('http') == 0 || postcode.indexOf('</a>') == 0){  
		var error = true;  
		$('.success, .pagecover, .loading').fadeOut(100);  
		$('#postcode').addClass("error");  
	}else{  
		$('#postcode').removeClass("error"); 
	}
	
	if(error == false){  
		
		$.post("cms/email/traitement_design.php", $("#email-design").serialize(),function(result){   
			if(result == 'sent'){ 
				$('.loading').fadeOut(100);
				$('.succeed').fadeIn(200);
				$('.success, .pagecover, .succeed').delay(2000).fadeOut(500); 
				resetForm();
				result == '';
			}else{ 
				$('#failed').fadeIn(500); 
			}  
		});  
	}
}); 