@extends("layout/homelayout")
@extends("layout/notification")
@section("content")
<!DOCTYPE html>
<html>
<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>

    input[type=text],input[type=number], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    div.container12 {
        margin-top: 50px;
        margin-left: 75px;
        margin-right: 75px;
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        margin-bottom: 100px;
    }


    .card {
        z-index: 0;
        background-color: #ECEFF1;
        padding-bottom: 20px;
        margin-top: 20px;
        margin-bottom: 90px;
        border-radius: 10px
    }

    .top {
        padding-top: 40px;
        padding-left: 13% !important;
        padding-right: 13% !important
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: #455A64;
        padding-left: 0px;
        margin-top: 30px
    }

    #progressbar li {
        list-style-type: none;
        font-size: 13px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar .step0:before {
        font-family: FontAwesome;
        content: "\f10c";
        color: #fff
    }

    #progressbar li:before {
        width: 40px;
        height: 40px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        background: #C5CAE9;
        border-radius: 50%;
        margin: auto;
        padding: 0px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 12px;
        background: #C5CAE9;
        position: absolute;
        left: 0;
        top: 16px;
        z-index: -1
    }
    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    #viewdetails,#processcompleted {
        position:relative;
        display:none;
        width: 800px;
        height: 200px;
        float:left;
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        position: absolute;
        left: -50%
    }

    #progressbar li:nth-child(2):after,
    #progressbar li:nth-child(3):after {
        left: -50%
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        position: absolute;
        left: 50%
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #651FFF
    }

    #progressbar li.active:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    .icon {
        width: 60px;
        height: 60px;
        margin-right: 15px
    }

    .icon-content {
        padding-bottom: 20px
    }

    @media screen and (max-width: 992px) {
        .icon-content {
            width: 50%
        }
    }
</style>
<body>

<div class="container12">
    <h3><center>Track your Blood Requests</h3></center>
    @if (Cookie::get('id') == null)
    <form action="/action_page.php"id="TrackForm">
        <label for="fname">Track id/Email</label>
        <input type="number" id="id" name="id" placeholder="Your name..">



        <label for="country">Track By</label>
        <select id="country" name="country">
            <option value="id">Track Id</option>
            <option value="email" disabled>email</option>
        </select>

        <input type="submit" value="Track">
    </form>
    @endif


    <div id="tracksection" class="container px-1 px-md-4 py-5 mx-auto">
        <div class="card">
            <div class="row d-flex justify-content-between px-3 top">
                <div class="d-flex">
                    <h5>ID:  <span class="text-primary font-weight-bold" id="idno">{{Cookie::get('id')??""}}</span></h5>
                </div>
                <div class="d-flex flex-column text-sm-right">
                    <p class="mb-0">Expected Arrival:  <span id="daterequested" class="font-weight-bold">{{$date??''}}</span></p>
                    <p>Blood Group: <span id="bloodgroup" class="font-weight-bold">{{Cookie::get('bloodgroup')??''}}</span></p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <ul id="progressbar" class="text-center">
                        <li id="list1" class="{{Cookie::get('status')&& Cookie::get('status')>=1? "active" : "" }} step0"></li>
                        <li id="list2" class="{{Cookie::get('status')&& Cookie::get('status')>=2? "active" : "" }} step0"></li>
                        <li id="list3" class="{{Cookie::get('status')&& Cookie::get('status')>=3? "active" : "" }} step0"></li>
                        <li id="list4" class="{{Cookie::get('status')&& Cookie::get('status')>=4? "active" : '' }} step0"></li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-between top">
                <div class="row d-flex icon-content"> <img class="icon" src="images/approved.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Blood<br>Requested</p>
                    </div>
                </div>
                <div class="row d-flex icon-content"> <img class="icon" src="images/completed.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Viewed By<br>Bloodbank</p>
                    </div>
                </div>
                <div class="row d-flex icon-content"> <img class="icon" src="images/9nnc9Et.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Approved</p>
                    </div>
                </div>
                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Donar<br>Assigned</p>
                    </div>
                </div>
                <div id="viewdetails">
                <a class="button" id="showcontact">Donar Details</a>
            </div>
                <div id="processcompleted">
                    <p style="color:green">You have received your blood, GET WELL SOON. We pray for your health</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><div id="bname">{{$name ?? 'Name'}}</div></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"><h6>Address:<div id="baddress"> {{$address??'Address'}}</div></h6><h6>Phone Number: <div id="bphone">{{$phone??'phone number'}}</div></h6>
                <h6>Donar Email: </h6><p id="bnotes">{{$notes?? 'email'}}</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary">Blood Recvd</a>
            </div>
        </div>
    </div>
</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script type="text/javascript">

    $('#TrackForm').on('submit',function(event){
        event.preventDefault();

        let id = $('#id').val();

        $.ajax({
            url: "/track-request",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                id:id,
            },
            success:function(response)
            {
                $('#idno').text(response.idnumber);
                $('#daterequested').text(response.date);
                $('#bloodgroup').text(response.bloodgroup);
                if(response.message!=null)
                {
                    alert(response.message);
                }

                if(response.status==1) {
                    jQuery('#list1').addClass("active");
                    document.getElementById('tracksection').scrollIntoView(true);
                }
                else if(response.status==2)
                {
                    jQuery('#list1').addClass("active");
                    jQuery('#list2').addClass("active");
                    document.getElementById('tracksection').scrollIntoView(true);
                }
                else if(response.status==3)
                {
                    jQuery('#list1').addClass("active");
                    jQuery('#list2').addClass("active");
                    jQuery('#list3').addClass("active");
                    document.getElementById('tracksection').scrollIntoView(true);
                }
                else if(response.status==4)
                {
                    jQuery('#list1').addClass("active");
                    jQuery('#list2').addClass("active");
                    jQuery('#list3').addClass("active");
                    jQuery('#list4').addClass("active");
                    document.getElementById('tracksection').scrollIntoView(true);
                    $('#viewdetails').css('display','inline-block');
                    $("#showcontact").attr("href", "viewdonarprofile?id="+response.idnumber);
                }
                else if(response.status==5)
                {
                    jQuery('#list1').addClass("active");
                    jQuery('#list2').addClass("active");
                    jQuery('#list3').addClass("active");
                    jQuery('#list4').addClass("active");
                    $('#processcompleted').css('display','inline-block');
                    document.getElementById('tracksection').scrollIntoView(true);


                }
                console.log(response);
            },
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#showcontact").click(function(){
            $('#myModal').modal('show');
        });
    });
</script>
<script type="text/javascript">

    $(document).on('click', '#showcontact',function(event){
        event.preventDefault();


        let id = $(this).attr('data-id');
        var _href = $(".btn-default").attr("href");
        $.ajax({
            url: $('#showcontact').attr('href'),
            type:"get",
            data:{
                "_token": "{{ csrf_token() }}",
            },
            success:function(response)
            {
                $('#bname').text(response.name);
                $('#bphone').text(response.phone);
                $('#baddress').text(response.address);
                $('#bnotes').text(response.email);
                $(".btn-primary").attr("href", "donation-process-completed?id="+response.id);
                console.log(response);
            },
        });
    });
</script>

<script type="text/javascript">

    $(document).on('click', '.btn-default',function(event){
        event.preventDefault();

        var _href = $(".btn-default").attr("href");
        $.ajax({
            url: $('.btn-default').attr('href'),
            type:"get",
            data:{
                "_token": "{{ csrf_token() }}",
            },
            success:function(response) {
                if (response.message == 'success') {
                    alert("your process is now completed, Take care and get well soon");
                }
                else
                {
                    alert("oops something went wrong, contact admin");
                }
                console.log(response);
            },
        });
    });
</script>
</html>
@endsection
