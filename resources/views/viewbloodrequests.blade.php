
@extends("layout/admin_layout")
@section("content")
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
            background-color: darkviolet;
            color: white;
        }
        .btn1 {
            background-color: darkviolet; /* Green */
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
<h3>Blood Requests</h3>
<table id="customers">
    <tr>
        <th>Name</th>
        <th>Blood Group</th>
        <th>Units</th>
        <th>city</th>
        <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;View Details</th>
    </tr>
    @foreach($requests as $r)
        <tr>
            <td>{{$r['name']}}</td>
            <td>{{$r['bloodgroup']}}</td>
            <td>{{$r['units']}}</td>
            <td>{{$r['city']}}</td>
            <td><button class="btn1"   data-id="{{$r->id}}" value={{$r['id']}}>View Details</button></td>

        </tr>
    @endforeach
</table>
</body>
</html>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><div id="bname">{{$name ?? 'Name'}}</div></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"><h6>Address:<div id="baddress"> {{$address??'Address'}}</div></h6><h6>Phone Number: <div id="bphone">{{$phone??'phone number'}}</div></h6>
                <h6>Complications: </h6><p id="bnotes">{{$notes?? 'Complications'}}</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-default"  data-dismiss="modal" >Cancel</a>
                <a class="btn btn-primary">Approve</a>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $(".btn1").click(function(){
            $('#myModal').modal('show');
        });
    });
</script>
<script type="text/javascript">

    $(document).on('click', 'button[data-id]',function(event){
        event.preventDefault();


        let id = $(this).attr('data-id');
        var _href = $(".btn-default").attr("href");
        $.ajax({
            url: "/admin-view-requests-particular",
            type:"get",
            data:{
                "_token": "{{ csrf_token() }}",
                id:id,
            },
            success:function(response)
            {
                $('#bname').text(response.name);
                $('#bphone').text(response.phone);
                $('#baddress').text(response.address);
                $('#bnotes').text(response.notes);
                $(".btn-default").attr("href", "admin-cancel-bloodrequest?id="+response.id);
                $(".btn-primary").attr("href", "admin-approve-bloodrequest?id="+response.id);
                console.log(response);
            },
        });
    });
</script>

<h3> Approved Blood Requests</h3>
<table id="customers">
    <tr>
        <th>Name</th>
        <th>Blood Group</th>
        <th>Units</th>
        <th>city</th>
        <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;View Details</th>
    </tr>
    @foreach($requests as $r)
        <tr>
            <td>{{$r['name']}}</td>
            <td>{{$r['bloodgroup']}}</td>
            <td>{{$r['units']}}</td>
            <td>{{$r['city']}}</td>
            <td><button class="btn1"   data-id="{{$r->id}}" value={{$r['id']}}>View Details</button></td>

        </tr>
    @endforeach
</table>
</body>
</html>




@endsection
