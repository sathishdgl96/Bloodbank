@extends("layout/homelayout")
@extends('layout/notification')
@section('content')
    <html data-wf-domain="littles-initial-project-d2b6b4.webflow.io" data-wf-page="6020f5974326bed8c202852c"
          data-wf-site="6020f596a26597378887194a" data-wf-status="1">
    <head>
        <meta charset="utf-8"/>
        <title>Little&#x27;s Initial Project</title>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="Webflow" name="generator"/>
        <link
            href="https://uploads-ssl.webflow.com/6020f596a26597378887194a/css/littles-initial-project-d2b6b4.webflow.9a282ba8e.css"
            rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
        <script type="text/javascript">WebFont.load({google: {families: ["DM Sans:regular,500,700"]}});</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"
                type="text/javascript"></script><![endif]-->
        <script type="text/javascript">!function (o, c) {
                var n = c.documentElement, t = " w-mod-";
                n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
            }(window, document);</script>
        <link href="https://uploads-ssl.webflow.com/img/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
        <link href="https://uploads-ssl.webflow.com/img/webclip.png" rel="apple-touch-icon"/>
    </head>
    <body>

    <section id="hero-layout" data-w-id="390c9858-96a6-4cd4-2c95-514dacddc4e3" style="opacity:0" class="section hero">
        <div class="w-container"><h1 class="heading"><span><strong>Blood Request Form</strong></span></h1></div>
        <div class="w-container">
            <div class="w-form">

                <form data-name="" action="/blood-request" method="post" class="form">
                    @csrf  <label for="name" class="field-label">Patient Name</label><input type="text"
                                                                                            class="text-field w-input"
                                                                                            maxlength="256"
                                                                                            name="name"
                                                                                            data-name="Name"
                                                                                            placeholder="enter your name"
                                                                                            id="name"  value="{{$name ?? ''}}"
                                                                                            required=""/><label
                        for="email" class="field-label-2">Email Address</label><input type="email"
                                                                                      class="text-field-2 w-input"
                                                                                      maxlength="256" name="email" value="{{$email ?? ''}}"
                                                                                      data-name="Email"
                                                                                      placeholder="enter  your email"
                                                                                      id="email"/><label for="ad-2"
                                                                                                         class="field-label-3">Hospital Admitted</label><input
                        type="text" class="w-input" maxlength="256" name="hospital" data-name="ad1" placeholder="Hospital Admitted"  value="{{$hospital ?? ''}}"
                        id="ad-2" required=""/><label for="node-2"
                                                      class="field-label-3">City</label><select
                        id="city" name="city" data-name="city" required="" class="w-select">
                        <option value="">Select one...</option>
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
                    </select><label for="State" class="field-label-3">State</label><select id="State" name="state"
                                                                                           data-name="State" required=""
                                                                                           class="w-select">
                        <option value="">Select one...</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                    </select><label for="country" class="field-label-3">Country</label><select id="country" name="country"
                                                                                               data-name="country"
                                                                                               required="" class="w-select">
                        <option value="India">India</option>
                    </select><label for="pin-code" class="field-label-3">Pin code</label><input type="textr"
                                                                                                class="w-input"
                                                                                                maxlength="256"
                                                                                                name="pincode"
                                                                                                data-name="pin code"
                                                                                                placeholder="pin code"
                                                                                                id="pin-code"value={{$pincode ?? 'hi'}}
                        required=""/><label
                        for="ph_n" class="field-label-3">Phone</label><input type="tel" class="w-input" maxlength="256"
                                                                             name="phone" data-name="ph_n"
                                                                             placeholder="Phone number" id="ph_n" value="{{$phone ?? ''}}"
                                                                             required=""/><label for="country-2"
                                                                                                 class="field-label-3">Blood
                        Group</label><select id="b_group" name="bloodgroup" data-name="b_group" required="" class="w-select">
                        <option value="">Select one...</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select><label for="units" class="field-label-3">Units Required</label><select id="units" name="units"
                                                                                                    data-name="units"
                                                                                                    class="w-select">
                        <option value="">Select one...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select><label for="date" class="field-label-3">Date</label><input type="date" class="w-input"
                                                                                        maxlength="256" name="date"
                                                                                        data-name="date"
                                                                                        placeholder="dd/mm/yyyy" id="date"
                                                                                        required=""/>
                    <label for="note" class="field-label-3">Note</label><input type="text"
                                                                               class="w-input"
                                                                               maxlength="256"
                                                                               name="note"
                                                                               data-name="note"
                                                                               placeholder="any further information"
                                                                               id="note"
                                                                               required=""/><input
                        type="submit" value="Submit" data-wait="Please wait..." class="submit-button w-button"/></form>
                <div class="w-form-done">
                    <div>Thank you! Your submission has been received!</div>
                </div>
                <div class="w-form-fail">
                    <div>Oops! Something went wrong while submitting the form.</div>
                </div>
            </div>
        </div>
    </section>


    </style></div>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=6020f596a26597378887194a"
            type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script src="https://uploads-ssl.webflow.com/6020f596a26597378887194a/js/webflow.1742d9b29.js"
            type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]--></body>
    </html>
@endsection
