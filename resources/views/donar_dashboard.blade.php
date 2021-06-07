@extends('layout/donar_layout')
@extends('layout/notification')
@section('content')
<div id="username"><b>Welcome,</b> {{ Session::get('email')}}</br></br>
<b>Blood Group:</b> {{$blood ?? ''}}</div>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
#username
{
right:10px;
position:absolute;
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
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
}

.button2:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
</style>
</head>
<body>
<h3 style="color:red">Donate Directly to Patients</h3>
<p style="font-size:12px">They need blood urgently!, you can save someone life by donating !</p>

<table id="customers">
  <tr>
    <th>Name</th>
    <th>Hospital/Address</th>
    <th>Phone Number</th>
    <th>Units</th>
    <th> Donate</th>
  </tr>
    @if(count($requests) > 0)
    @foreach($requests as $r)
        <tr>
            <td>{{$r['name']}}</td>
            <td>{{$r['hospitalname']}}</td>
            <td>{{$r['phone']}}</td>
            <td>{{$r['units']}}</td>
            <td><a class="btn1"  href="/donated?id={{$r['id']}}" data-id="{{$r->id}}" value={{$r['id']}}>Donate</a></td>
        </tr>
    @endforeach
    @endif
    <tr style="color:lightslategray">
        <td>Blood Bank</td>
        <td>-</td>
        <td>044-2707649</td>
        <td>2</td>
        <td><a class="btn1"   href="/donated?id=bloodbank" >Donate</a></td>
    </tr>
</table>
</body>
</html>



@stop
