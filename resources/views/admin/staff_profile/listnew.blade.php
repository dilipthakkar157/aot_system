@extends('admin.layouts.app')

@section('content')
<script type="text/javascript" src="{{ url('js/staff_profile.js') }}"></script>
<div class="">
   <div class="page-title">
      <div class="title_left">
         <h3 style="white-space: nowrap;">Staff Profiles</h3>
      </div>
   </div>
   <div class="clearfix"></div>
   @include('admin.staff_profile.popup')
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

                     <a href="javascript:void(0);" class="btn btn-new-license btn-add" id="btnAddStaffProfile"><i class="fa fa-plus icon-add"></i> Add Profile</a>
                  </li>
               </ul>
            </div>

            <div class="x_content">
               <div class="alert alert-success" id="successMsg"></div>
               <div class="row">
                  <div class="col-sm-12 alert alert-danger error-msg hide"></div>
                   <div class="col-sm-12">
                     <div class="card-box table-responsive">
                        <table id="tbl-staff-profile" class="" style="width:100%">
                           <thead>
                               <tr>
                                   <th>Name</th>
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