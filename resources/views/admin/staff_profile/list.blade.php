<!DOCTYPE html>
<html lang="en">
<head>
  <title>Staff Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="baseUrl" content="{{ url('') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="{{ url('js/staff_profile.js') }}"></script>
  <style type="text/css">
    .required, .errors_class {
        color: red;
    }
  </style>
</head>
<body>

<div class="container">
  <div>
      <h2>Staff Profile</h2>
      <a href="javascript:void(0)" class="btn btn-primary" id="btnAddStaffProfile">Add Profile</a>  
  </div>
  @include('admin.staff_profile.popup')
  <div class="alert alert-success" id="successMsg">
      
  </div>
  <table class="table table-bordered table-responsive">
    <thead>
      <tr>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="staff_list">
    </tbody>
  </table>
</div>