@extends("layout/admin_layout")
@section("content")
@if(Session::has('message'))
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="alert alert-success">
        <strong>Congratulations! </strong>{{Session::get('message')}}
    </div>

@endif
<html>
<style>
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    #submit{
        width: 100%;
        background-color:green;
        color: white;
        padding: 14px 20px;
        margin: 0px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: darkviolet;
    }

    #serviceform {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>
<body>
<h3>Add new Service Area</h3>

<div id="serviceform">
    <form action="admin-addservice-action" method="post">
        @csrf
        <label for="fname">City</label>
        <input type="text" id="city" name="city" value="city" placeholder="Add service city">
        <label for="country">State</label>
        <select id="country" name="state">
            <option value="tamilnadu">Tamil Nadu</option>
            <option value="kerala">Kerala</option>
            <option value="andrapradesh">Andhra pradesh</option>
        </select>

        <input type="submit" id="submit" value="Submit" name="SubmitButton">
    </form>
</div>

</body>
</html>
@endsection
