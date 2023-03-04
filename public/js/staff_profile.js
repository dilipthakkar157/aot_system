$(document).ready(function(){
	token = $('meta[name="csrf-token"]').attr('content');
	url = $('meta[name="baseUrl"]').attr('content');
	// getStaffProfileData();
	$("#successMsg").css("display","none");
	$("#btnAddStaffProfile").click(function(){
		$("#staff_profile_header").html("Add Role");
		resetForm();
		$("#addStaffProfile").modal();
  	});

  	$("#btnSubmitStaffProfile").click(function(){
  		role = $("#role").val();
  		id = $("#id").val();
  		$.ajax({
  			headers: {
		        'X-CSRF-TOKEN': token
		    },
		    url : url + "/admin/staff-role-permission/store",
		    method : "POST",
		    data : {"role":role,"id":id},
		    dataType : "json",
		    success : function(successRes) {
		    	if(successRes['status'] == false) {
		    		printErrorMsg(successRes['messages']);
		    	} else {
		    		resetForm();
					$("#addStaffProfile").modal('hide');					
		    		$("#successMsg").css("display","block");
		    		$("#successMsg").html(successRes['messages']);
		    		// getStaffProfileData();
		    		table.draw();
		    	}
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
  		});
  	});

  	var table = $("#tbl-staff-profile").DataTable({
		processing: true,
      	serverSide: true,
      	serverMethod: 'GET',
      	ajax: url + "/admin/staff-role-permission/list",
      	dom: "Blfrtip",
	    columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'role', name: 'role'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
	});

  	$('body').on('click', '.deleteStaffProfile', function () {
  		id = $(this).attr('data-id');
  		if (confirm('Are you sure you want to delete this record?')) {
			$.ajax({
				headers: {
			        'X-CSRF-TOKEN': token
			    },
			    url : url + "/admin/staff-role-permission/delete/"+id,
			    method : "DELETE",
			    dataType : "json",
			    success : function(successRes) {
			    	$("#id").val("0");
			    	$("#successMsg").css("display","block");
		    		$("#successMsg").html(successRes['messages']);
		    		table.draw();
			    },error : function(failRes) {
			    	console.log(failRes);
			    }
			});
		}
  	});

  	$('body').on('click', '.editStaffProfile', function () {
  		id = $(this).attr('data-id');
  		$("#staff_profile_header").html("Edit Role");
		html = '';
		$.ajax({
		    url : url + "/admin/staff-role-permission/edit/"+id,
		    method : "GET",
		    dataType : "json",
		    success : function(successRes) {
		    	$("#role").val(successRes['data']['role']);
		    	$("#id").val(successRes['data']['id']);
		    	$("#addStaffProfile").modal();
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
		});
	});  	
});

function printErrorMsg(errors) {
	$.each(errors, function(k,v) {
		$("#"+k+"-error").html(v);
	});
}

function resetForm() {
	$("#id").val("0");
	$('#frmAddStaffProfile').trigger("reset");
	$(".errors_class").html("");
}

function getStaffProfileData() {
	url = $('meta[name="baseUrl"]').attr('content');
	html = '';
	$.ajax({
	    url : url + "/admin/staff-role-permission/list",
	    method : "GET",
	    dataType : "json",
	    success : function(successRes) {
	    	console.log(successRes['data'].length);
	    	if(successRes['data'].length > 0) {
	    		$.each(successRes['data'], function(k, v) {
	    			html += '<tr>';
	    			html += '<td>'+v['name']+'</td>';
	    			if(v['is_edit'] == 1) {
	    				varAction = '<a href="javascript:void(0);" onclick=editStaffProfile("'+v['id']+'") class="btn btn-warning">Edit</a> <a class="btn btn-danger" onclick=deleteStaffProfile("'+v['id']+'") href="javascript:void(0);">Delete</a>';
	    			} else {
	    				varAction = '-';
	    			}
	    			html += '<td>'+varAction+'</td>';
	    			html += '</tr>';
	    		});
	    	} else {
	    		html += '<tr>';
    			html += '<td colspan="2">No Records Found</td>';
    			html += '</tr>';
	    	}
	    	$("#staff_list").html(html);
	    },error : function(failRes) {
	    	console.log(failRes);
	    }
	});
}