@extends("layout/admin_layout")
@section("content")
<!DOCTYPE html>
<html>
<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<h3>Review Donars</h3>
<table id="customers">
    <tr>
        <th>Username</th>
        <th>Health Problems</th>
        <th>Accept/reject</th>
    </tr>
    @if(count($requests) > 0)
        @foreach($requests as $r)
            <tr>
                <td>{{$r['email']}}</td>
                <td>{{$r['healthcheck']}}</td>
                <td><a class="btn1"  href="/acceptreview?id={{$r['email']}}" >Accept</a> | <a class="btn1"  href="/rejectreview?id={{$r['email']}}" >Reject</a> </td>
            </tr>
        @endforeach
    @endif


</table>

</body>
</html>
@endsection
