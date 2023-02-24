<!DOCTYPE html>
<html lang="en">
<head>
  <title>Company Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Company Profile</h2>            
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
      </tr>
    </thead>
    <tbody>  
    @if(count($company_profile)>0)
      @foreach($company_profile as $k => $v)
      <tr>
        <td>{{$v->company_name}}</td>
        <td>{{$v->company_registered_business}}</td>
        <td>{{$v->zip_registered_address}}</td>
        <td>{{$v->country_registered_address}}</td>
        <td>{{$v->state_registered_address}}</td>
        <td>{{$v->city_registered_address}}</td>
        <td>{{$v->company_correspondence_address}}</td>
        <td>{{$v->zip_correspondence_address}}</td>
        <td>{{$v->country_correspondence_address}}</td>
        <td>{{$v->state_correspondence_address}}</td>
        <td>{{$v->city_correspondence_address}}</td>
        <td>{{$v->company_correspondence_email}}</td>
        <td>{{$v->company_correspondence_telephone}}</td>
        <td>{{$v->company_registration_number}}</td>
        <td>{{$v->tax_registration_number}}</td>
        <td>{{$v->vat_number}}</td>
      </tr>
      @endforeach
    @else
      <tr>
        <td colspan="16">No Records Found</td>
      </tr>
    @endif
    </tbody>
    
  </table>
</div>

</body>
</html>
