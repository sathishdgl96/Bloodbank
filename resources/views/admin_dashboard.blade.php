@extends("layout/admin_layout")
    @section("content")
<!DOCTYPE html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            padding: 10px;

        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
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

        .formsubmit{
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
            background-color: darkviolet;
        }

        #quickaction {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            margin-bottom:10px;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="column">
        <div id="quickaction">
            <h3>Quick Actions: [Restrict User] </h3>
            <div>
                <form  class="restrictuser" method="GET">
                    <label for="fname">Email</label>
                    <input type="text" class="email" name="firstname" placeholder="Your email">

                    <label for="country">Action</label>
                    <select class="action" name="country">
                        <option value=8>Deactivate</option>
                        <option value=0>Delete</option>
                    </select>

                    <input type="submit" class='formsubmit' value="Submit">
                </form>
            </div>
        </div>

    </div>


    <div class="column">
        <div id="quickaction">
            <h3>Quick Actions:[Reactivate User] </h3>
            <div>
                <form class="restrictuser" method="GET">
                    <label for="fname">Email</label>
                    <input type="text" class="email" name="firstname" placeholder="Your email">

                    <label for="country">Action</label>
                    <select class="action" name="country">
                        <option value=9>Reactivate</option>
                        <option value=1>Reactivate & Mark as verified</option>
                    </select>

                    <input type="submit" class='formsubmit' value="Submit">
                </form>
            </div>
        </div>

    </div>
</div>


<div id="quickaction">
    <h3>Login as User [ Note: you cant login to other admin profiles] </h3>
    <div>
        <form onsubmit="popupwindow()">
            <label for="fname">Email</label>
            <input type="text" id="email" name="firstname" placeholder="Your email">
            <input type="submit" class='formsubmit' value="Enter >>">
        </form>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function popupwindow(url, title, w, h) {
        var w = 2000;
        var h = 1000;
        let id = $('#email').val();
        var left = Number((screen.width/2)-(w/2));
        var tops = Number((screen.height/2)-(h/2));
        window.open("admin/login-as-user?email="+id, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+tops+', left='+left);
    }
</script>

<script type="text/javascript">

    $('.restrictuser').on('submit',function(event){
        event.preventDefault();

        let email = $('.email').val();
        let action=$('.action').val();

        $.ajax({
            url: "admin/admin-restrict-user",
            type:"GET",
            data:{
                "_token": "{{ csrf_token() }}",
                email:email,
                action:action,
            },
            success:function(response)
            {
                    alert(response);
                console.log(response.status);
            },
        });
    });
</script>
</html>
@endsection
