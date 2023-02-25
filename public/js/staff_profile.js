$(document).ready(function(){
	token = $('meta[name="csrf-token"]').attr('content');
	url = $('meta[name="baseUrl"]').attr('content');
	getStaffProfileData();
	$("#successMsg").css("display","none");
	$("#btnAddStaffProfile").click(function(){
		$("#staff_profile_header").html("Add Profile");
		resetForm();
		$("#addStaffProfile").modal();
  	});

  	$("#btnSubmitStaffProfile").click(function(){
  		profile_name = $("#profile_name").val();
  		id = $("#id").val();
  		$.ajax({
  			headers: {
		        'X-CSRF-TOKEN': token
		    },
		    url : url + "/admin/staff-profile/store",
		    method : "POST",
		    data : {"profile_name":profile_name,"id":id},
		    dataType : "json",
		    success : function(successRes) {
		    	if(successRes['status'] == false) {
		    		printErrorMsg(successRes['messages']);
		    	} else {
		    		resetForm();
					$("#addStaffProfile").modal('hide');					
		    		$("#successMsg").css("display","block");
		    		$("#successMsg").html(successRes['messages']);
		    		getStaffProfileData();
		    	}
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
	    url : url + "/admin/staff-profile/list",
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

function editStaffProfile(id) {
	$("#staff_profile_header").html("Edit Profile");
	url = $('meta[name="baseUrl"]').attr('content');
	html = '';
	$.ajax({
	    url : url + "/admin/staff-profile/edit/"+id,
	    method : "GET",
	    dataType : "json",
	    success : function(successRes) {
	    	$("#profile_name").val(successRes['data']['name']);
	    	$("#id").val(successRes['data']['id']);
	    	$("#addStaffProfile").modal();
	    },error : function(failRes) {
	    	console.log(failRes);
	    }
	});
}

function deleteStaffProfile(id) {
	if (confirm('Are you sure you want to delete this record?')) {
		url = $('meta[name="baseUrl"]').attr('content');
		token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			headers: {
		        'X-CSRF-TOKEN': token
		    },
		    url : url + "/admin/staff-profile/delete/"+id,
		    method : "DELETE",
		    dataType : "json",
		    success : function(successRes) {
		    	$("#id").val("0");
		    	$("#successMsg").css("display","block");
	    		$("#successMsg").html(successRes['messages']);
	    		getStaffProfileData();
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
		});
	}
}