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
        <style>
            #fielderror
            {
                color:red;
                font-size: 12px;
            }
        </style>
    </head>
    <body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="https://media.mehrnews.com/d/2019/06/15/4/3153884.jpg" alt="">
                </div>
                <div class="signup-form">
                    <form method="POST" action="donar_medical_profile" class="register-form" id="register-form">
                        <h2>Donar Medical Profile</h2>
                            @csrf
                            <div class="form-group">
                                <label for="address">* Health Status (Specify if you have any chronic problem)</label>
                                <input type="text" name="healthcheck" id="address" value="{{$healthcheck ?? 'good' }}"required/>
                            </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="bloodgroup">* Haemoglobin level:</label>
                                <input type="number" name="haemoglobin"  value="{{$haemoglobin ?? '' }}" id="bloodgroup" />
                                <p id="fielderror">{{$errors->first('haemoglobin')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">BMI Value</label>
                            <input type="number" name="bmi" value="{{$bmi ?? '' }}"id="address" required/>
                            <p id="fielderror">{{$errors->first('bmi')}}</p>
                        </div>
                        <div class="form-radio">
                            <label for="gender" class="radio-label">* Alcholic</label>
                            <div class="form-radio-item">
                                <input type="radio" name="Isalcohol" id="male" value=1 {{(isset($isalcohol) && $isalcohol==1)? "checked" :"" }}>
                                <label for="male">Yes</label>
                                <span class="check"></span>
                            </div>
                            <div class="form-radio-item">
                                <input type="radio" name="Isalcohol" id="female" value=0 {{(isset($isalcohol) && $isalcohol==0)? "checked" :"" }}>
                                <label for="female">No</label>
                                <span class="check"></span>
                            </div>
                            <p id="fielderror">{{$errors->first('Isalcohol')}}</p>
                        </div>
                        <div class="form-group">
                            <label for="birth_date">* Last Donated(YYYY-MM-DD) :</label>
                            <input type="date" name="lastdonated" value="{{$lastdonated ?? '' }}" id="birth_date">
                        </div>
                        <div class="form-group">
                            <label for="course">In which interval, your'e wiling to donate?</label>
                            <div class="form-select">
                                <select name="interval" id="course">
                                    <option value=""></option>
                                    <option value="3"{{ (isset($interval) && $interval==3)? "selected  " : "" }}>3 months</option>
                                    <option value="6"{{ (isset($interval) && $interval==6)? "selected  " : "" }}>6 months</option>
                                </select>
                                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                        <div class="form-submit">
                            <input type="submit" value="Reset All" class="submit" name="reset" id="reset" />
                            <input type="submit" value="Submit" class="submit" name="submit" id="submit" />
                        </div>
                        <p>By clicking submit, you are acknowledging that you are willing to donate</p>
                        <p>* marked fields are important, providing misleading information may lead to serious problem</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    </body>
    </html>
@stop
