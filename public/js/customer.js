$(document).ready(function(){
    $("#customer_date_of_birth").datepicker({dateFormat: "dd/mm/yy"});
	$(".commonSuccessMsg").css('display','none');
	token = $('meta[name="csrf-token"]').attr('content');
	url = $('meta[name="baseUrl"]').attr('content');
	
	var table = $("#tbl-customers-list").DataTable({
		processing: true,
      	serverSide: true,
      	serverMethod: 'GET',
      	ajax: url + "/company/customer/list",
      	dom: "Blfrtip",
	    columns: [
            {data: 'first_name', name: 'first_name'},
            {data: 'middle_name', name: 'middle_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'place_of_birth', name: 'place_of_birth'},
            {data: 'social_security_number', name: 'social_security_number'},
            {data: 'email', name: 'email'},
            {data: 'three_letter_code', name: 'three_letter_code'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
	});

    $(".btnOpenCustomerModal").click(function(){
		resetCustomerForm();
		$("#customer_header").html("Add Customer");
		$("#addCustomerModal").modal();
  	});
    
    $(".btnSubmitCustomerData").click(function(){
        var formData = new FormData($("#frmAddCustomer")[0]);
        $.ajax({
            headers: {
              'X-CSRF-TOKEN': token
          },
          url : url + "/company/customer/store",
          method : "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType : "json",
          success : function(successRes) {
              if(successRes['status'] == false) {
                  printCustomerErrorMsg(successRes['messages']);
              } else {
                  resetCustomerForm();
                  $("#addCustomerModal").modal('hide');					
                  $(".commonSuccessMsg").css("display","block");
                  $(".commonSuccessMsg").html(successRes['messages']);
                  table.draw();
              }
          },error : function(failRes) {
              console.log(failRes);
          }
        });
    });

    $('body').on('click', '.editCustomer', function () {
		resetCustomerForm();
  		id = $(this).attr('data-id');
  		$("#customer_header").html("Edit Customer");
		html = '';
		$.ajax({
		    url : url + "/company/customer/edit/"+id,
		    method : "GET",
		    dataType : "json",
		    success : function(successRes) {
		    	$("#customer_id").val(successRes['data']['id']);
		    	$("#customer_first_name").val(successRes['data']['first_name']);
		    	$("#customer_middle_name").val(successRes['data']['middle_name']);
		    	$("#customer_last_name").val(successRes['data']['last_name']);
		    	$("#customer_date_of_birth").val(successRes['data']['date_of_birth']);
		    	$("#customer_place_of_birth").val(successRes['data']['place_of_birth']);
		    	$("#customer_social_security_number").val(successRes['data']['social_security_number']);
		    	$("#customer_email").val(successRes['data']['email']);
		    	$("#addCustomerModal").modal();
		    },error : function(failRes) {
		    	console.log(failRes);
		    }
		});
	});

	$('body').on('click', '.deleteCustomer', function () {
  		id = $(this).attr('data-id');
  		if (confirm('Are you sure you want to delete this record?')) {
			$.ajax({
				headers: {
			        'X-CSRF-TOKEN': token
			    },
			    url : url + "/company/customer/delete/"+id,
			    method : "DELETE",
			    dataType : "json",
			    success : function(successRes) {
			    	$(".commonSuccessMsg").css("display","block");
		    		$(".commonSuccessMsg").html(successRes['messages']);
		    		table.draw();
			    },error : function(failRes) {
			    	console.log(failRes);
			    }
			});
		}
  	});

});

function resetCustomerForm(){
    $("#customer_id").val("0");
	$('#frmAddCustomer').trigger("reset");
	$(".errors_class").html("");
}

function printCustomerErrorMsg(errors){
	$.each(errors, function(k,v) {
		$("#customer_"+k+"-error").html(v);
	});
}