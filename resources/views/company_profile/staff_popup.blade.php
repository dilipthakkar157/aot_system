<!-- Add/Edit Staff Profile Modal -->
<div class="modal fade" id="addStaff" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title" id="staff_header"></h4>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmAddStaff">
            <input type="hidden" name="id" id="staff_id" value="0">
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="three_letter_code">Three Letter Code: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="staff_three_letter_code" placeholder="Enter three letter code" name="three_letter_code">
                    <span id="staff_three_letter_code-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prefix">Prefix: <span class="required">*</span></label>
                    <select class="form-control" name="prefix" id="staff_prefix">
                      <option value="">Select Prefix</option>
                      <option value="Mr">Mr</option>
                      <option value="Mrs">Mrs</option>
                      <option value="Ms">Ms</option>
                    </select>
                    <span id="staff_prefix-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">First Name: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="staff_name" placeholder="Enter first name" name="name">
                    <span id="staff_name-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" class="form-control" id="staff_middle_name" placeholder="Enter middle name" name="middle_name">
                    <span id="staff_middle_name-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="last_name">Last Name: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="staff_last_name" placeholder="Enter last name" name="last_name">
                    <span id="staff_last_name-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email: <span class="required">*</span></label>
                    <input type="email" class="form-control" id="staff_email" placeholder="Enter email" name="email">
                    <span id="staff_email-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="citizenship">Citizenship: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="staff_citizenship" placeholder="Enter citizenship" name="citizenship">
                    <span id="staff_citizenship-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_of_birth">Date Of Birth: <span class="required">*</span></label>
                    <input type="text" class="form-control" id="staff_dob" placeholder="Enter date of birth" name="date_of_birth">
                    <span id="staff_date_of_birth-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="passport_id">Passport Id:</label>
                    <input type="text" class="form-control" id="staff_passport_id" placeholder="Enter passport id" name="passport_id">
                    <span id="staff_passport_id-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="role">Role: <span class="required">*</span></label>
                    <select id="staff_role" name="role" class="form-control" onchange="getStaffPermissions(this.value)">
                        <option value="">Select Role</option>
                    </select>
                    <span id="staff_role-error" class="errors_class"></span>
                  </div>
                </div>

                <div class="col-md-12">
                  <table class="table table-bordered">
                      <!-- <thead> -->
                        <tr>
                          <th>Read/View</th>
                          <th>Edit</th>
                          <th>Delete</th>
                          <th>User Management</th>
                        </tr>
                      <!-- </thead> -->
                      <tbody id="staff_permissions">
                        <tr>
                          <td colspan="4">
                              No data found
                          </td>
                        </tr>
                      </tbody>
                  </table>
                </div>

            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSubmitStaffData">Submit</button>
      </div>
    </div>
    
  </div>
</div>