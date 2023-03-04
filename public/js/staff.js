$(document).ready(function(){
	$("#date_of_birth").datepicker({dateFormat: "dd/mm/yy"});
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
		resetForm();
		getRoles();
		$("#staff_header").html("Add Staff");
		$("#addStaff").modal();
  	});

  	$("#btnSubmitStaffData").click(function(){
  		role = $("#role").val();
  		id = $("#id").val();
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
		    		printErrorMsg(successRes['messages']);
		    	} else {
		    		resetForm();
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
  		getRoles();
  		id = $(this).attr('data-id');
  		$("#staff_header").html("Edit Staff");
		html = '';
		$.ajax({
		    url : url + "/company/staff/edit/"+id,
		    method : "GET",
		    dataType : "json",
		    success : function(successRes) {
		    	$("#id").val(successRes['data']['id']);
		    	$("#three_letter_code").val(successRes['data']['three_letter_code']);
		    	$("#prefix").val(successRes['data']['prefix']);
		    	$("#name").val(successRes['data']['name']);
		    	$("#middle_name").val(successRes['data']['middle_name']);
		    	$("#last_name").val(successRes['data']['last_name']);
		    	$("#citizenship").val(successRes['data']['citizenship']);
		    	$("#date_of_birth").val(successRes['data']['date_of_birth']);
		    	$("#passport_id").val(successRes['data']['passport_id']);
		    	$("#role").val(successRes['data']['role']);
		    	getPermissions(successRes['data']['role']);
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

function resetForm(){
	$("#id").val("0");
	$('#frmAddStaff').trigger("reset");
	$(".errors_class").html("");
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