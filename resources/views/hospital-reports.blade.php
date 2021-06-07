@extends('layout/notification')
@extends('layout/hospital_layout')
@section('content')
    <html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            #customers {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #customers td, #customers th {
                border: 0px solid #ddd;
                padding: 20px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #e2e3e5;}

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color:red;
                color: white;
            }
            .btn1 {
                background-color: limegreen; /* Green */
                border: none;
                color: white;
                padding: 10px 22px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 50px;
                margin-left: 140px;
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
            }


            .btn1:hover {
                box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
            }
        </style>
    </head>
    <body>
    <h4 style="color:sandybrown">Hospital Activites</h4>
    @if(isset($inprogress))
    @if(count($inprogress)>0)
        <table id="customers">
            <tr>
                <th>Patient Name</th>
                <th>Units</th>
                <th>Blood Group</th>
                <th>Phone</th>
                <th>Date Needed</th>
                <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Status</th>
            </tr>
            @if(isset($inprogress)and $inprogress!=null)
                @foreach($inprogress as $r)
                    <tr>
                        <td>{{$r['name']}}</td>
                        <td>{{$r['units']}}</td>
                        <td>{{$r['bloodgroup']}}</td>
                        <td>{{$r['phone']}}</td>
                        <td>{{$r['date']}}</td>
                        <td>@if($r['status']==1) Requested
                            @elseif($r['status']==2) Viewed By Admin
                            @elseif($r['status']==3) Approved
                            @elseif($r['status']==4)Found Donar
                            @elseif($r['status']==5)Completed
                            @else Cancelled
                            @endif</td>
                    </tr>
                @endforeach
            @endif

            @else<p>No recent Activites found</p>
            @endif
        </table>
    </body>
    <p style="color:green">{{$nextdonation?? ''}}</p>
    </html>
    @endif
@endsection
