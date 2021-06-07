@extends('layout/donar_layout')
@extends('layout/notification')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>donar basic profile</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="https://media.mehrnews.com/d/2019/06/15/4/3153884.jpg" alt="">
                </div>
                <div class="signup-form">
                    <form method="POST" action="updateprofile" class="register-form" id="register-form">
                        <h2>Donar Profile</h2>
                        <div class="form-row">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input type="text" name="name" id="name" value="{{$name ?? '' }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="bloodgroup">Blood Group:</label>
                                <input type="text" name="blood" id="bloodgroup"  value="{{ $blood ?? '' }}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address :</label>
                            <input type="text" name="address" id="address" value="{{ $address ?? '' }}" required/>
                        </div>
                        <div class="form-radio">
                            <label for="gender" class="radio-label">Gender :</label>
                            <div class="form-radio-item">
                                <input type="radio" name="gender" id="male" value="male"  {{(isset($gender) && $gender=='male')? "checked" :"" }}>
                                <label for="male">Male</label>
                                <span class="check"></span>
                            </div>
                            <div class="form-radio-item">
                                <input type="radio" name="gender" value="female" id="female" {{ (isset($gender) && $gender=='female')? "checked" : "" }}>
                                <label for="female">Female</label>
                                <span class="check"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="state">State :</label>
                                <div class="form-select">
                                    <select name="state" id="state">
                                        <option value=""></option>
                                        <option value="us" {{ (isset($state) && $state=='us')? "selected  " : "" }}>America</option>
                                        <option value="uk"{{ (isset($state) &&$state=='uk')? "selected  " : "" }}>English</option>
                                    </select>
                                    <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city">City :</label>
                                <div class="form-select">
                                    <select name="city" id="city">
                                        <option value=""></option>
                                        <?php
                                        $filter = ['_id' => ['$gt' => 0]];
                                        $manager = new \MongoDB\Driver\Manager( 'mongodb://localhost:27017' );
                                        $query = new MongoDB\Driver\Query($filter);
                                        try {
                                            $rows = $manager->executeQuery('bloodbank.service_area', $query);
                                        }
                                        catch(Exception $e)
                                        {
                                            echo $e;
                                        }
                                        foreach($rows as $r){
                                            $array = get_object_vars($r);
                                            echo"<option value='",$array['tamilnadu'],"'>";
                                            echo $array["tamilnadu"];
                                            echo"</option>";
                                        }
                                        ?>
                                        <option value="losangeles"  {{ (isset($city) &&$city=='losangeles')? "selected  " : "" }}>Los Angeles</option>
                                        <option value="washington"{{ (isset($city) && $city=='washington')? "selected  " : "" }}>Washington</option>
                                    </select>
                                    <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birth_date">DOB (YYYY-MM-DD) :</label>
                            <input type="text" name="dob" id="birth_date" value="{{ $dob ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pincode :</label>
                            <input type="text" name="pincode" id="pincode" value="{{ $pincode ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="course">Country:</label>
                            <div class="form-select">
                                <select name="country" id="course">
                                    <option value=""></option>
                                    <option value="india" {{ (isset($city) && $country=='india')? "selected  " : "" }}>India</option>
                                    <option value="others">Outside of india</option>
                                </select>
                                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Phone number:</label>
                            <input type="phone" name="phone" id="phone" value="{{ $phone ?? '' }}" />
                        </div>
                        <div class="form-submit">
                            <input type="submit" value="Reset All" class="submit" name="reset" id="reset" />
                            <input type="submit" value="Next" class="submit" name="submit" id="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
@stop
