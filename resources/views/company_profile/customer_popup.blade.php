<!-- Add/Edit Staff Profile Modal -->
<div class="modal fade" id="addCustomerModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title" id="customer_header"></h4>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmAddCustomer" enctype="multipart/form-data">
            <input type="hidden" name="id" id="customer_id" value="0">
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="first_name">First Name: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="customer_first_name" placeholder="Enter First Name" name="first_name">
                    <span id="customer_first_name-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="middle_name">Middle Name: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="customer_middle_name" placeholder="Enter Middle Name" name="middle_name">
                    <span id="customer_middle_name-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="last_name">Last Name: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="customer_last_name" placeholder="Enter Last Name" name="last_name">
                    <span id="customer_last_name-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_of_birth">Date Of Birth: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="customer_date_of_birth" placeholder="Enter Date Of Birth" name="date_of_birth">
                    <span id="customer_date_of_birth-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="place_of_birth">Place Of Birth: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="customer_place_of_birth" placeholder="Enter Place Of Birth" name="place_of_birth">
                    <span id="customer_place_of_birth-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="social_security_number">Social Security Number: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="customer_social_security_number" placeholder="Enter Social Security Number" name="social_security_number">
                    <span id="customer_social_security_number-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email: <span class="required">*</span></label>
                    <input type="email" class="form-control" id="customer_email" placeholder="Enter Email" name="email">
                    <span id="customer_email-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="photo">Photo: </label>
                    <input type="file" class="form-control" id="customer_photo" name="photo">
                    <span id="customer_photo-error" class="errors_class"></span>
                  </div>
                </div>

            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btnSubmitCustomerData">Submit</button>
      </div>
    </div>
    
  </div>
</div>