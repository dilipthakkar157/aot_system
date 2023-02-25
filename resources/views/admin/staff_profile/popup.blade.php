<!-- Add Staff Profile Modal -->
<div class="modal fade" id="addStaffProfile" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="staff_profile_header"></h4>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmAddStaffProfile">
            <input type="hidden" name="id" id="id" value="0">
            <div class="form-group">
              <label for="profile_name">Profile Name: <span class="required">*</span></label>
              <input type="text" class="form-control" id="profile_name" placeholder="Enter profile name" name="profile_name">
              <span id="profile_name-error" class="errors_class"></span>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSubmitStaffProfile">Submit</button>
      </div>
    </div>
    
  </div>
</div>