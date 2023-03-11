$(document).ready(function(){
    $("#date_of_birth").datepicker({dateFormat: "dd/mm/yy"});
	$("#errorMsg").css("display","none");
	token = $('meta[name="csrf-token"]').attr('content');
	url = $('meta[name="baseUrl"]').attr('content');

	$("#hid_same_as_registered_business").val(0);
	$("#same_as_registered_business").change(function(){
		if($(this).prop('checked') == true) {
			$("#hid_same_as_registered_business").val(1);
			$("#company_correspondence_address").val($("#company_registered_business").val());
			$("#zip_correspondence_address").val($("#zip_registered_address").val());
			getCorrespondenceCounties($("#country_registered_address").val());
			getCorrespondenceState($("#country_registered_address").val(), $("#state_registered_address").val());
			getCorrespondenceCities($("#state_registered_address").val(), $("#city_registered_address").val());
		} else {
			getCorrespondenceCounties($("#hid_country_correspondence_address").val());
			getCorrespondenceState($("#hid_country_correspondence_address").val(), $("#hid_state_correspondence_address").val());
			getCorrespondenceCities($("#hid_state_correspondence_address").val(), $("#hid_city_correspondence_address").val());
			$("#company_correspondence_address").val($("#hid_company_correspondence_address").val());
			$("#zip_correspondence_address").val($("#hid_zip_correspondence_address").val());
		}
	});

	$(".common_correspondence_class").on('input', function(){
		if($("#same_as_registered_business").prop('checked') == true) {
			$("#same_as_registered_business").prop('checked',false);
		}
	});

	$("#btnSubmitCompanyProfile").on('click', function(e){
		e.preventDefault();    
	    var formData = new FormData($("#frmCompanyProfile")[0]);
	    $.ajax({
	    	headers: {
		        'X-CSRF-TOKEN': token
		    },
	        url: url + "/company/profile/update",
	        type: 'POST',
	        data: formData,
	        contentType: false,
	        processData: false,
	        dataType : "json",
	        success: function (data) {
	            if(data['status'] == false) {
		    		printErrorMsg(data['messages']);
		    	} else {
					$("#editCompanyProfile").modal('hide');					
		    		$("#successMsg").css("display","block");
		    		$("#successMsg").html(data['messages']);
		    		alert("Profile successfully updated.");
		    		resetForm();
		    	}
	        },error: function (error) {
	        	console.log(error);
	        }
	    });
	});

	$("#btnCommonChangePassword").on('click', function(e){
		e.preventDefault();
	    $.ajax({
	    	headers: {
		        'X-CSRF-TOKEN': token
		    },
	        url: url + "/change-password",
	        type: 'POST',
	        data: $("#frmCommonChangePassword").serialize(),
	        dataType : "json",
	        success: function (data) {
	            if(data['status'] == false) {
		    		printErrorMsg(data['messages']);
		    	} else {
					$("#commonChangePassword").modal('hide');
		    		alert("Password successfully changed.");
		    		window.location.href = url + "/common/logout";
		    	}
	        },error: function (error) {
	        	console.log(error);
	        }
	    });
	});

	$("#btnUpdateStaffProfileData").click(function(){
  		$.ajax({
  			headers: {
		        'X-CSRF-TOKEN': token
		    },
		    url : url + "/staff/update",
		    method : "POST",
		    data : $("#frmUpdateStaffProfile").serialize(),
		    dataType : "json",
		    success : function(successRes) {
		    	if(successRes['status'] == false) {
		    		printErrorMsg(successRes['messages']);
		    	} else {
		    		resetForm1();
					$("#updateStaffProfile").modal('hide');
					alert("Profile successfully updated");
		    	}
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
  		});
  	});

});

function editCompanyProfile() {
	$("#company_profile_header").html("Edit Company Profile");
		$(".errors_class").html("");
		getCounties();
		url = $('meta[name="baseUrl"]').attr('content');
		html = '';
		$.ajax({
		    url : url + "/company/profile/edit",
		    method : "GET",
		    dataType : "json",
		    success : function(successRes) {
		    	$("#id").val(successRes['data']['id']);
		    	$("#company_name").val(successRes['data']['company_name']);
		    	$("#company_registered_business").val(successRes['data']['company_registered_business']);
		    	$("#zip_registered_address").val(successRes['data']['zip_registered_address']);

		    	$("#hid_company_correspondence_address").val(successRes['data']['company_correspondence_address']);
		    	$("#hid_zip_correspondence_address").val(successRes['data']['zip_correspondence_address']);
		    	
		    	$("#country_registered_address").val(successRes['data']['country_registered_address']);
		    	getRegisteredState(0,successRes['data']['state_registered_address'], successRes['data']['city_registered_address']);

		    	$("#company_correspondence_address").val(successRes['data']['company_correspondence_address']);
		    	$("#zip_correspondence_address").val(successRes['data']['zip_correspondence_address']);

		    	$("#country_correspondence_address").val(successRes['data']['country_correspondence_address']);

		    	$("#hid_country_correspondence_address").val(successRes['data']['country_correspondence_address']);
		    	$("#hid_state_correspondence_address").val(successRes['data']['state_correspondence_address']);
		    	$("#hid_city_correspondence_address").val(successRes['data']['city_correspondence_address']);
		    	
		    	getRegisteredState(1,successRes['data']['state_correspondence_address'], successRes['data']['city_correspondence_address']);

		    	$("#company_correspondence_email").val(successRes['data']['company_correspondence_email']);
		    	$("#company_correspondence_telephone").val(successRes['data']['company_correspondence_telephone']);
		    	$("#company_registration_number").val(successRes['data']['company_registration_number']);
		    	$("#tax_registration_number").val(successRes['data']['tax_registration_number']);
		    	$("#vat_number").val(successRes['data']['vat_number']);

		    	$("#editCompanyProfile").modal();
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
		});
}

function getCounties() {
	url = $('meta[name="baseUrl"]').attr('content');
	country = '';
	$.ajax({
	    url : url + "/get-countries",
	    method : "GET",
	    dataType : "json",
	    success : function(successRes) {
	    	$.each(successRes['data'], function(k,v) {
	    		country += '<option value="'+v['id']+'">'+v['name']+'</option>';
	    	});
	    	$("#country_registered_address").html(country);
	    	$("#country_correspondence_address").html(country);
	    },error : function(failRes) {
	    	console.log(failRes);
	    }
	});
}

function getRegisteredState(type,selected_val=0,city_selected_val=0) {
	if(type == 0){
		country_id = $("#country_registered_address").val();
	} else if(type == 1) {
		country_id = $("#country_correspondence_address").val();
	}
	url = $('meta[name="baseUrl"]').attr('content');
	state = '';
	if(country_id) {
		$.ajax({
		    url : url + "/get-states/"+country_id,
		    method : "GET",
		    dataType : "json",
		    success : function(successRes) {
		    	$.each(successRes['data'], function(k,v) {
		    		state += '<option value="'+v['id']+'">'+v['name']+'</option>';
		    	});
		    	if(type == 0){
					$("#state_registered_address").html(state);
					if(selected_val>0){
						$("#state_registered_address").val(selected_val);
		    			getRegisteredCities(0,city_selected_val);
					}
				} else if(type == 1) {
					$("#state_correspondence_address").html(state);
					if(selected_val>0){
						$("#state_correspondence_address").val(selected_val);
						getRegisteredCities(1,city_selected_val);
					}
				}
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
		});
	}
}

function getRegisteredCities(type,selected_val=0) {
	if(type == 0){
		state_id = $("#state_registered_address").val();
	} else if(type == 1) {
		state_id = $("#state_correspondence_address").val();
	}
	url = $('meta[name="baseUrl"]').attr('content');
	city = '';
	if(state_id)
	{
		$.ajax({
		    url : url + "/get-cities/"+state_id,
		    method : "GET",
		    dataType : "json",
		    success : function(successRes) {
		    	$.each(successRes['data'], function(k,v) {
		    		city += '<option value="'+v['id']+'">'+v['name']+'</option>';
		    	});
		    	if(type == 0){
					$("#city_registered_address").html(city);
					if(selected_val>0){
						$("#city_registered_address").val(selected_val);
					}
				} else if(type == 1) {
					$("#city_correspondence_address").html(city);
					if(selected_val>0){
						$("#city_correspondence_address").val(selected_val);
					}
				}
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
		});
	}
}

function getCorrespondenceCounties(country_id){
	url = $('meta[name="baseUrl"]').attr('content');
	country = '';
	$.ajax({
	    url : url + "/get-countries",
	    method : "GET",
	    dataType : "json",
	    success : function(successRes) {
	    	$.each(successRes['data'], function(k,v) {
	    		country += '<option value="'+v['id']+'">'+v['name']+'</option>';
	    	});
	    	$("#country_correspondence_address").html(country);
	    	$("#country_correspondence_address").val(country_id);
	    },error : function(failRes) {
	    	console.log(failRes);
	    }
	});
}

function getCorrespondenceState(country_id,state_id){
	if (country_id !== "") {
		country_id = country_id;
	} else {
		country_id = 0;
	}
	if(country_id > 0) {
		url = $('meta[name="baseUrl"]').attr('content');
		state = '';
		$.ajax({
		    url : url + "/get-states/"+country_id,
		    method : "GET",
		    dataType : "json",
		    success : function(successRes) {
		    	if(successRes['data'].length > 0){
			    	$.each(successRes['data'], function(k,v) {
			    		state += '<option value="'+v['id']+'">'+v['name']+'</option>';
			    	});
			    	$("#state_correspondence_address").html(state);
			    	$("#state_correspondence_address").val(state_id);
		    	} else {
		    		$("#state_correspondence_address").html('<option value="0">Select State</option>');
		    	}
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
		});
	} else {
		$("#state_correspondence_address").html('<option value="0">Select State</option>');
	}
}

function getCorrespondenceCities(state_id,city_id){
	if (state_id !== "") {
		state_id = state_id;
	} else {
		state_id = 0;
	}
	if(state_id > 0) {
		url = $('meta[name="baseUrl"]').attr('content');
		city = '';
		$.ajax({
		    url : url + "/get-cities/"+state_id,
		    method : "GET",
		    dataType : "json",
		    success : function(successRes) {
		    	if(successRes['data'].length>0){
			    	$.each(successRes['data'], function(k,v) {
			    		city += '<option value="'+v['id']+'">'+v['name']+'</option>';
			    	});
			    	$("#city_correspondence_address").html(city);
			    	$("#city_correspondence_address").val(city_id);
		    	} else {
		    		$("#city_correspondence_address").html('<option value="0">Select City</option>');
		    	}
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
		});
	} else {
		$("#city_correspondence_address").html('<option value="0">Select City</option>');
	}
}

function resetForm() {
	$('#frmCompanyProfile').trigger("reset");
	$(".errors_class").html("");
}

function resetForm1(){
	$('#frmUpdateStaffProfile').trigger("reset");
	$(".errors_class").html("");
	$("#permissions").html('<tr><td colspan="4">No data found</td></tr>');
}

function printErrorMsg(errors) {
	$.each(errors, function(k,v) {
		$("#"+k+"-error").html(v);
	});
}

function commonChangePassword(type){
	$(".errors_class").html("");
	if(type==1){
		$("#common_changepassword_header").html("Company Change Password");
	}else if(type==2){
		$("#common_changepassword_header").html("Staff Change Password");
	}else if(type==3){
		$("#common_changepassword_header").html("Customer Change Password");
	}
	$("#type").val(type);
	$("#commonChangePassword").modal();
}

function editStaffProfile(){
    getRoles();
	$.ajax({
    	headers: {
	        'X-CSRF-TOKEN': token
	    },
        url: url + "/staff/edit_profile",
        type: 'GET',
        dataType : "json",
        success: function (successRes) {
            console.log(successRes);
            $("#three_letter_code").val(successRes['data']['three_letter_code']);
	    	$("#prefix").val(successRes['data']['prefix']);
	    	$("#name").val(successRes['data']['name']);
	    	$("#middle_name").val(successRes['data']['middle_name']);
	    	$("#last_name").val(successRes['data']['last_name']);
	    	$("#citizenship").val(successRes['data']['citizenship']);
	    	$("#date_of_birth").val(successRes['data']['date_of_birth']);
	    	$("#passport_id").val(successRes['data']['passport_id']);
	    	$("#role").val(successRes['data']['role']);
	    	$("#email").val(successRes['data']['email']);
	    	getPermissions(successRes['data']['role']);
            $("#updateStaffProfile").modal();
        },error: function (error) {
        	console.log(error);
        }
    });
}

function getRoles(){
	url = $('meta[name="baseUrl"]').attr('content');
	country = '';
	$.ajax({
	    url : url + "/get-roles",
	    method : "GET",
	    dataType : "json",
	    success : function(successRes) {
	    	country = '<option value="">Select Role</option>';
	    	$.each(successRes['data'], function(k,v) {
	    		country += '<option value="'+v['id']+'">'+v['role']+'</option>';
	    	});
	    	$("#role").html(country);
	    },error : function(failRes) {
	    	console.log(failRes);
	    }
	});
}

function getPermissions(role_id){
	url = $('meta[name="baseUrl"]').attr('content');
	var permissions = '';
	$.ajax({
	    url : url + "/get-permissions/"+role_id,
	    method : "GET",
	    dataType : "json",
	    success : function(successRes) {
			permissions += '<tr>';
			if(successRes['data'].length>0){
		    	$.each(successRes['data'], function(k,v) {
		    		act2 = '';
		    		for (var i = 0; i < v['actions'].length; i++) {
		    			act2 += '<li>'+v['actions'][i]+'</li><br/>';
		    		}
		    		permissions += '<td>'+act2+'</td>';
		    	});
		    	permissions += '</tr>';
		    } else {
		    	permissions += '<tr><td colspan="4">No data found</td></tr>';
		    }
	    	$("#permissions").html(permissions);
	    },error : function(failRes) {
	    	console.log(failRes);
	    }
	});
}