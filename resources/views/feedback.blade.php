@extends('layout/homelayout')
@section('content')
    <link rel="stylesheet" href="css/feedback.css">
<div class="elfsight-app-f44fd71c-3a9c-41f8-b918-6337daa6f722"></div>
<p style="color:#de1f26;margin-top:40px;font-weight:bold;font-size:25px;">FEEDBACK</p>
<div class="container-feedback">
    <form action="feedback-status"method="GET">

        <label for="fname">Name</label>
        <input type="text" id="fname" name="name" placeholder="Your name..">
        <label for="lname">Email</label>
        <input type="text" id="lname" name="email" placeholder="Your email..">

        <label for="subject">Date of Donation</label>
        <textarea id="subject" name="subject" placeholder="Last Donation Date" style="height:200px"></textarea>

        <h1>How do you feel about your experience?</h1>

        <input type="radio" id="op1" name="op1" value="Very Good" >
        <label for="op1"> Very Good</label><br>
        <input type="radio" id="op2" name="op1" value="Good">
        <label for="op2"> Good</label><br>
        <input type="radio" id="op3" name="op1" value="Average">
        <label for="op3"> Average</label><br>
        <input type="radio" id="op4" name="op1" value="Should Improve">
        <label for="op4"> Should Improve</label><br><br>
        <label for="comments">Comments</label>
        <textarea name="comments" rows="15" cols="50" placeholder="enter your comments"></textarea><br>
        <input type="submit" value="Submit" onclick="myFunction()" style="background:#de1f26;font-weight:bold;font-size:15px;color:white;border-radius:30px;"></form></br></div>
    </form>
    <script>
        function myFunction() {
            alert("Form is Submitted. Thank You!!!")
        }
    </script>

</body>
</html>
@stop
