<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>
<style>
    table {
        width:100%;
    }
    table td {
        border: 2px solid #ddd;
        padding: 5px;
    }
    h2 {
        text-align:center;
    }
</style>
<body>
    <h2>Customer Information</h2>
    <table>
        <tr>
            <td>First Name</td>
            <td>{{$data->first_name}}</td>
        </tr>
        <tr>
            <td>Middle Name</td>
            <td>{{$data->middle_name}}</td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>{{$data->last_name}}</td>
        </tr>
        <tr>
            <td>Date Of Birth</td>
            <td>{{$data->date_of_birth}}</td>
        </tr>
        <tr>
            <td>Place Of Birth</td>
            <td>{{$data->place_of_birth}}</td>
        </tr>
        <tr>
            <td>Social Security Number</td>
            <td>{{$data->social_security_number}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$data->email}}</td>
        </tr>
        <tr>
            <td>3LC</td>
            <td>{{$data->three_letter_code}}</td>
        </tr>
    </table>
</body>
</html>