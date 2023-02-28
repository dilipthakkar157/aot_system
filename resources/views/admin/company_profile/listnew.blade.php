@extends('admin.layouts.app')

@section('content')
<style type="text/css">
    .required, .errors_class {
        color: red;
    }
  </style>
<script type="text/javascript" src="{{ url('js/company_profile.js') }}"></script>
<div class="">
   <div class="page-title">
      <div class="title_left">
         <h3 style="white-space: nowrap;">Company Profiles</h3>
      </div>
   </div>
   <div class="clearfix"></div>
   @include('admin.company_profile.popup')
   <div class="row">
      <div class="col-md-12 col-sm-12 ">
         <div class="x_panel">
            
            <div class="x_title" style="border-bottom: none;">
               <div class="clearfix"></div>
               <ul class="nav navbar-right panel_toolbox">
                  <li class="d-flexx">
                     <a href="#" class="btn btn-new-license btn-other dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter icon-filter"></i> Filter Data</a>
                     <ul class="dropdown-menu export-poup">
                        <li class="export-left"><a href="#">Filter</a></li>
                        <li class="reset export-right"><a href="#">Reset</a></li>
                      </ul>

                     <!-- <a href="#" data-toggle="modal" data-target="#exampleModalLong" class="btn btn-new-license btn-other"><i class="fa fa-upload icon-export"></i> Export Data</a> -->

                     <a href="javascript:void(0)" class="btn btn-new-license btn-add" id="btnAddCompanyProfile"><i class="fa fa-plus icon-add"></i> Add Company Profile</a>
                  </li>
               </ul>
            </div>

            <div class="x_content">
               <div class="alert alert-success" id="successMsg"></div>
               <div class="row">
                  <div class="col-sm-12 alert alert-danger error-msg hide"></div>
                   <div class="col-sm-12">
                     <div class="card-box table-responsive">
                        <table id="tbl-company-profile" class="" style="width:100%">
                           <thead>
                               <tr>
                                   <!-- <th>Id</th> -->
                                   <th>Comapny Name</th>
                                   <th>Company Registered Business</th>
                                   <th>Zip Registered Address</th>
                                   <th>Country Registered Address</th>
                                   <th>State Registered Address</th>
                                   <th>City Registered Address</th>
                                   <th>Company Correspondence Address</th>
                                   <th>Zip Correspondence Address</th>
                                   <th>Country Correspondence Address</th>
                                   <th>State Correspondence Address</th>
                                   <th>City Correspondence Address</th>
                                   <th>Company Correspondence Email</th>
                                   <th>Company Correspondence Telephone</th>
                                   <th>Company Registration Number</th>
                                   <th>Tax Registration Number</th>
                                   <th>Action</th>
                                 </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                   </div>
               </div>
           </div>

         </div>
      </div>
   </div>
</div>
@endsection