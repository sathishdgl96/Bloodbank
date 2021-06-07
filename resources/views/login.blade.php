@extends("/layout/homelayout")
@section("content")
<body>
@extends("/layout/notification")
<link rel="stylesheet" href="css/loginstyle.css">
<div class="mainContent"id="register">
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                Login Form</div>
            <div class="title signup">
                Signup Form</div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" class="hiddenRadioButton" name="slide" id="login" checked>
                <input type="radio" class="hiddenRadioButton" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab">
                </div>
            </div>
            <div class="form-inner">
                <form action="/dashboard" method="POST" class="login">
                 @csrf
                    <div class="field">
                        <input type="text" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="pass-link">
                        <a href="#">Forgot password?</a></div>
                    <div class="field btn">
                        <div class="btn-layer">
                        </div>
                        <input type="submit" value="Login">
                    </div>
                    <div class="signup-link">
                        Not a member? <a href="">Signup now</a></div>
                </form>
                <form action="/register" method="POST" class="signup">
                    @csrf
                    <div class="field">
                        <input type="text" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="field">
                        <input type="password" name="cpassword"placeholder="Confirm password" required>
                    </div>
                    <div class="cntr">

                        <label for="opt3" class="userTypeRadio">
                            <input type="radio" name="userType" value="0" id="opt3" class="hidden"/>
                            <span class="label"></span>Donar
                        </label>

                        <label for="opt4" class="userTypeRadio">
                            <input type="radio" name="userType" value="1" id="opt4" class="hidden"/>
                            <span class="label"></span>Hospital
                        </label>

                    </div>

                    <div class="field btn">
                        <div class="btn-layer">
                        </div>
                        <input type="submit" value="Signup">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const loginText = document.querySelector(".title-text .login");
    const loginForm = document.querySelector("form.login");
    const loginBtn = document.querySelector("label.login");
    const signupBtn = document.querySelector("label.signup");
    const signupLink = document.querySelector("form .signup-link a");
    signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
    });
    loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
    });
    signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
    });
</script>
@endsection
