
@extends('layout/hospital_layout')
@extends('layout/notification')
@section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>hospital profile</title>

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
                    <form method="POST" action="updatehospitalprofile" class="register-form" id="register-form">
                        @csrf
                        <h2>Hospital Profile</h2>
                        <div class="form-group">
                            <label for="address">Hospital Name :</label>
                            <input type="text" name="name" id="address" value="{{ $name ?? '' }}" required/>
                        </div>
                        <div class="form-group">
                            <label for="address">Address :</label>
                            <input type="text" name="address" id="address" value="{{ $address ?? '' }}" required/>
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
                            <input type="submit" value="Submit" class="submit" name="submit" id="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    </body>
    </html>
@endsection
