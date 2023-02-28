<!DOCTYPE html>
<html lang="en">
<head>
  <title>Company Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="baseUrl" content="{{ url('') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="{{ url('js/company_profile.js') }}"></script>
  <style type="text/css">
    .required, .errors_class {
        color: red;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Company Profile</h2>
  @include('admin.company_profile.popup')
  <div class="alert alert-success" id="successMsg">
      
  </div>
  <table class="table table-bordered table-responsive">
    <thead>
      <tr>
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
        <th>Vat Number</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="company_profile_lists">
      
    </tbody>
    
  </table>
</div>

</body>
</html>