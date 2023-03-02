<!-- Company Profile Modal -->
<div class="modal fade" id="editCompanyProfile" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content" style="width: 150%;">
      <form method="POST" id="frmCompanyProfile" enctype="multipart/form-data">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title" id="company_profile_header">Edit Company Profile</h4>
        </div>
        <div class="modal-body">
            <!-- <input type="hidden" name="id" id="id" value="0"> -->
            <input type="hidden" name="hid_same_as_registered_business" id="hid_same_as_registered_business">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="company_name">Company Name: <span class="required">*</span></label>
                              <input type="text" class="form-control" id="company_name" placeholder="Enter Company Name" name="company_name">
                              <span id="company_name-error" class="errors_class"></span>
                          </div>          
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="company_registered_business">Company Registered Business: <span class="required">*</span></label>
                              <input type="text" class="form-control common_correspondence_class" id="company_registered_business" placeholder="Enter Company Registered Business" name="company_registered_business">
                              <span id="company_registered_business-error" class="errors_class"></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="zip_registered_address">Zip Registered Address: <span class="required">*</span></label>
                              <input type="text" class="form-control common_correspondence_class" id="zip_registered_address" placeholder="Zip Registered Address" name="zip_registered_address">
                              <span id="zip_registered_address-error" class="errors_class"></span>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="country_registered_address">Country Registered Address: <span class="required">*</span></label>
                              <select class="form-control common_correspondence_class" name="country_registered_address" id="country_registered_address" onchange="getRegisteredState(0)">
                                  <option value="0">Select Country</option>
                              </select>
                              <span id="country_registered_address-error" class="errors_class"></span>
                          </div>          
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="state_registered_address">State Registered Address: <span class="required">*</span></label>
                              <select class="form-control common_correspondence_class" name="state_registered_address" id="state_registered_address" onchange="getRegisteredCities(0)">
                                  <option value="0">Select State</option>
                              </select>
                              <span id="state_registered_address-error" class="errors_class"></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="city_registered_address">City Registered Address: <span class="required">*</span></label>
                              <select class="form-control common_correspondence_class" name="city_registered_address" id="city_registered_address">
                                  <option value="0">Select City</option>
                              </select>
                              <span id="city_registered_address-error" class="errors_class"></span>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <input type="checkbox" id="same_as_registered_business" name="same_as_registered_business">&nbsp; Same As Registered Business
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="company_correspondence_address">Company Correspondence Business: <span class="required">*</span></label>
                              <input type="hidden" id="hid_company_correspondence_address">
                              <input type="text" class="form-control" id="company_correspondence_address" placeholder="Enter Company Correspondence Business" name="company_correspondence_address">
                              <span id="company_correspondence_address-error" class="errors_class"></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="zip_correspondence_address">Zip Correspondence Address: <span class="required">*</span></label>
                              <input type="hidden" id="hid_zip_correspondence_address">
                              <input type="text" class="form-control" id="zip_correspondence_address" placeholder="Enter Zip Correspondence Address" name="zip_correspondence_address">
                              <span id="zip_correspondence_address-error" class="errors_class"></span>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="country_correspondence_address">Country Correspondence Address: <span class="required">*</span></label>
                              <input type="hidden" id="hid_country_correspondence_address">
                              <select class="form-control" name="country_correspondence_address" id="country_correspondence_address" onchange="getRegisteredState(1)">
                                  <option value="0">Select Country</option>
                              </select>
                              <span id="country_correspondence_address-error" class="errors_class"></span>
                          </div>          
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="state_correspondence_address">State Correspondence Address: <span class="required">*</span></label>
                              <input type="hidden" id="hid_state_correspondence_address">
                              <select class="form-control" name="state_correspondence_address" id="state_correspondence_address" onchange="getRegisteredCities(1)">
                                  <option value="0">Select State</option>
                              </select>
                              <span id="state_correspondence_address-error" class="errors_class"></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="city_correspondence_address">City Correspondence Address: <span class="required">*</span></label>
                              <input type="hidden" id="hid_city_correspondence_address">
                              <select class="form-control" name="city_correspondence_address" id="city_correspondence_address">
                                  <option value="0">Select City</option>
                              </select>
                              <span id="city_correspondence_address-error" class="errors_class"></span>
                          </div>
                      </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="company_correspondence_email">Company Correspondence Email: <span class="required">*</span></label>
                              <input type="text" class="form-control" id="company_correspondence_email" placeholder="Enter Company Correspondence Email" name="company_correspondence_email">
                              <span id="company_correspondence_email-error" class="errors_class"></span>
                          </div>          
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="company_correspondence_telephone">Company Correspondence Telephone: <span class="required">*</span></label>
                              <input type="text" class="form-control" id="company_correspondence_telephone" placeholder="Enter Company Correspondence Telephone" name="company_correspondence_telephone">
                              <span id="company_correspondence_telephone-error" class="errors_class"></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="company_registration_number">Company Registration Number: <span class="required">*</span></label>
                              <input type="text" class="form-control" id="company_registration_number" placeholder="Enter Company Registration Number" name="company_registration_number">
                              <span id="company_registration_number-error" class="errors_class"></span>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="tax_registration_number">Tax Registration Number: <span class="required">*</span></label>
                              <input type="text" class="form-control" id="tax_registration_number" placeholder="Enter Tax Registration Number" name="tax_registration_number">
                              <span id="tax_registration_number-error" class="errors_class"></span>
                          </div>          
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="vat_number">Vat Number: <span class="required">*</span></label>
                              <input type="text" class="form-control" id="vat_number" placeholder="Enter Vat Number" name="vat_number">
                              <span id="vat_number-error" class="errors_class"></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="company_logo">Company Logo:</label>
                              <input type="file" class="form-control" id="company_logo" name="company_logo">
                              <span id="company_logo-error" class="errors_class"></span>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSubmitCompanyProfile">Submit</button>
        </div>
      </form>
    </div>
    
  </div>
</div>


<!-- Change Password Modal -->
<div class="modal fade" id="companyChangePassword" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <form method="POST" id="frmCompanyChangePassword">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title" id="company_profile_header">Company Change Password</h4>
        </div>
        <div class="modal-body">
            <div class="alert alert-error" id="errorMsg"></div>
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="current_password">Current Password: <span class="required">*</span></label>
                      <input type="password" class="form-control" id="current_password" placeholder="Enter Current Password" name="current_password">
                      <span id="current_password-error" class="errors_class"></span>
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="new_password">New Password: <span class="required">*</span></label>
                      <input type="password" class="form-control" id="new_password" placeholder="Enter New Password" name="new_password">
                      <span id="new_password-error" class="errors_class"></span>
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="confirm_new_password">Comfirm New Password: <span class="required">*</span></label>
                      <input type="password" class="form-control" id="confirm_new_password" placeholder="Enter Confirm New Password" name="confirm_new_password">
                      <span id="confirm_new_password-error" class="errors_class"></span>
                  </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnCompanyChangePassword">Save</button>
        </div>
      </form>
    </div>
    </div>
</div>