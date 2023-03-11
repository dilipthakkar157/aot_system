$(document).ready(function(){
	$("#staff_dob").datepicker({dateFormat: "dd/mm/yy"});
	$("#successMsg").css('display','none');
	token = $('meta[name="csrf-token"]').attr('content');
	url = $('meta[name="baseUrl"]').attr('content');
	
	var table = $("#tbl-staff").DataTable({
		processing: true,
      	serverSide: true,
      	serverMethod: 'GET',
      	ajax: url + "/company/staff/list",
      	dom: "Blfrtip",
	    columns: [
            {data: 'three_letter_code', name: 'three_letter_code'},
            {data: 'employee_no', name: 'employee_no'},
            {data: 'prefix', name: 'prefix'},
            {data: 'name', name: 'name'},
            {data: 'middle_name', name: 'middle_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'citizenship', name: 'citizenship'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'passport_id', name: 'passport_id'},
            {data: 'role', name: 'role'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
	});

	$("#btnAddStaff").click(function(){
		resetStaffForm();
		getStaffRoles();
		$("#staff_header").html("Add Staff");
		$("#addStaff").modal();
  	});

  	$("#btnSubmitStaffData").click(function(){
  		role = $("#staff_role").val();
  		id = $("#staff_id").val();
  		$.ajax({
  			headers: {
		        'X-CSRF-TOKEN': token
		    },
		    url : url + "/company/staff/store",
		    method : "POST",
		    data : $("#frmAddStaff").serialize(),
		    dataType : "json",
		    success : function(successRes) {
		    	if(successRes['status'] == false) {
		    		printStaffErrorMsg(successRes['messages']);
		    	} else {
		    		resetStaffForm();
					$("#addStaff").modal('hide');					
		    		$("#successMsg").css("display","block");
		    		$("#successMsg").html(successRes['messages']);
		    		table.draw();
		    	}
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
  		});
  	});

  	$('body').on('click', '.editStaff', function () {
		resetStaffForm();
		getStaffRoles();
  		id = $(this).attr('data-id');
  		$("#staff_header").html("Edit Staff");
		html = '';
		$.ajax({
		    url : url + "/company/staff/edit/"+id,
		    method : "GET",
		    dataType : "json",
		    success : function(successRes) {
		    	$("#staff_id").val(successRes['data']['id']);
		    	$("#staff_three_letter_code").val(successRes['data']['three_letter_code']);
		    	$("#staff_prefix").val(successRes['data']['prefix']);
		    	$("#staff_name").val(successRes['data']['name']);
		    	$("#staff_middle_name").val(successRes['data']['middle_name']);
		    	$("#staff_last_name").val(successRes['data']['last_name']);
		    	$("#staff_citizenship").val(successRes['data']['citizenship']);
		    	$("#staff_dob").val(successRes['data']['date_of_birth']);
		    	$("#staff_passport_id").val(successRes['data']['passport_id']);
		    	$("#staff_role").val(successRes['data']['role']);
		    	$("#staff_email").val(successRes['data']['email']);
		    	getStaffPermissions(successRes['data']['role']);
		    	$("#addStaff").modal();
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
		});
	});

	$('body').on('click', '.deleteStaff', function () {
  		id = $(this).attr('data-id');
  		if (confirm('Are you sure you want to delete this record?')) {
			$.ajax({
				headers: {
			        'X-CSRF-TOKEN': token
			    },
			    url : url + "/company/staff/delete/"+id,
			    method : "DELETE",
			    dataType : "json",
			    success : function(successRes) {
			    	$("#successMsg").css("display","block");
		    		$("#successMsg").html(successRes['messages']);
		    		table.draw();
			    },error : function(failRes) {
			    	console.log(failRes);
			    }
			});
		}
  	});
});

function resetStaffForm(){
	$("#staff_id").val("0");
	$('#frmAddStaff').trigger("reset");
	$(".errors_class").html("");
	$("#staff_permissions").html('<tr><td colspan="4">No data found</td></tr>');
}	

function getStaffRoles(){
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
	    	$("#staff_role").html(country);
	    },error : function(failRes) {
	    	console.log(failRes);
	    }
	});
}

function getStaffPermissions(role_id){
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
	    	$("#staff_permissions").html(permissions);
	    },error : function(failRes) {
	    	console.log(failRes);
	    }
	});
}

function printStaffErrorMsg(errors){
	$.each(errors, function(k,v) {
		$("#staff_"+k+"-error").html(v);
	});
}