<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cera Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('guestasset')}}/img/logo/cera_golden_logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('guestasset')}}/css/loginstyles.min.css" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('guestasset')}}/css/font-awesome.min.css" type="text/css">
</head>

<body>

    @if (session('successMessage'))
    <div class="toast-wrapper">
        <div class="toast" style="border-left: 5px solid #2ecc71;">
            <div class="content">
                <div class="icon" style="background: #2ecc71;"><i class="fa fa-check"></i></div>
                <div class="details">
                    <span>Success</span>
                    <p>{{ session('successMessage') }}</p>
                </div>
            </div>
            <div class="close-icon"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
    </div>
    @endif

    @if (session('errorMessage'))
    <div class="toast-wrapper">
        <div class="toast" style="border-left: 5px solid #e43333;">
            <div class="content">
                <div class="icon" style="background: #e43333;"><i class="fa fa-check"></i></div>
                <div class="details">
                    <span>Error</span>
                    <p>{{session('errorMessage')}}</p>
                </div>
            </div>
            <div class="close-icon"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
    </div>
    @endif


    <div class="centered-container">
        <div class="container">
            <section id="formHolder">

                <div class="row">
                    <div class="col-sm-6 brand">
                        <div class="heading">
                            <a href="{{url('/')}}" style="text-decoration: none;">
                                <img id="_logo" src="{{asset('guestasset')}}/img/logo/cera_golden_logo.png" data-filename="Logo.png">
                            </a>
                            <h2>CERA TILES</h2>
                        </div>
                        <br />
                    </div>

                    <div class="col-sm-6 form">
                        <div class="login form-peice {{session('signupErrorMessage') ? 'switched' : ''}}">
                            <form class="login-form" id="loginform" action="{{url('/auth/verifylogin')}}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="signinemail">Email Adderss</label>
                                    <input type="email" name="signinemail" id="signinemail" required="required" value="">
                                </div>

                                <div class="form-group">
                                    <label for="signinpassword">Password</label>
                                    <input type="password" name="signinpassword" id="signinpassword" required="required" value="">
                                </div>

                                <div class="CTA">
                                    <div style="display: flex; justify-content: space-between;">
                                        <a href="#" class="switch signup-btn" style="text-decoration: none; color: white;"><i class="fa fa-chevron-left" aria-hidden="true"></i> Sign Up</a>
                                        <button type="submit" class="submit-form-btn">Sign In</button>
                                    </div>
                                    <hr>

                                    <div class="open-ids" style="margin-top: 35px; text-align: center;">
                                        <a class="auth-provider google-login" href="{{url('auth/google')}}" style="text-decoration: none;">
                                            <svg aria-hidden="true" class="svg-icon" width="18" height="18" viewBox="0 0 18 18">
                                                <g>
                                                    <path d="M16.51 8H8.98v3h4.3c-.18 1-.74 1.48-1.6 2.04v2.01h2.6a7.8 7.8 0 0 0 2.38-5.88c0-.57-.05-.66-.15-1.18z" fill="#4285F4"></path>
                                                    <path d="M8.98 17c2.16 0 3.97-.72 5.3-1.94l-2.6-2a4.8 4.8 0 0 1-7.18-2.54H1.83v2.07A8 8 0 0 0 8.98 17z" fill="#34A853"></path>
                                                    <path d="M4.5 10.52a4.8 4.8 0 0 1 0-3.04V5.41H1.83a8 8 0 0 0 0 7.18l2.67-2.07z" fill="#FBBC05"></path>
                                                    <path d="M8.98 4.18c1.17 0 2.23.4 3.06 1.2l2.3-2.3A8 8 0 0 0 1.83 5.4L4.5 7.49a4.77 4.77 0 0 1 4.48-3.3z" fill="#EA4335"></path>
                                                </g>
                                            </svg>
                                            Log in with Google
                                        </a>
                                        <a class="auth-provider facebook-login" href="{{url('auth/facebook')}}" style="text-decoration: none;">
                                            <svg aria-hidden="true" class="svg-icon" width="18" height="18" viewBox="0 0 18 18">
                                                <path d="M1.88 1C1.4 1 1 1.4 1 1.88v14.24c0 .48.4.88.88.88h7.67v-6.2H7.46V8.4h2.09V6.61c0-2.07 1.26-3.2 3.1-3.2.88 0 1.64.07 1.87.1v2.16h-1.29c-1 0-1.19.48-1.19 1.18V8.4h2.39l-.31 2.42h-2.08V17h4.08c.48 0 .88-.4.88-.88V1.88c0-.48-.4-.88-.88-.88H1.88z" fill="#fff"></path>
                                            </svg>
                                            Log in with Facebook
                                        </a>
                                    </div>

                                </div>
                                <div class="open-ids" style="bottom:0px; text-align: center;">
                                    <a href="{{url('auth/forgotpassword')}}" style="text-decoration: none;">
                                        Forgot Password
                                    </a>
                                </div>
                            </form>
                        </div>


                        <div class="signup form-peice {{session('signupErrorMessage') ? '' : 'switched'}}">
                            <form class="signup-form" action="{{url('/auth/signup')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="signupemail" class="active">Email Adderss</label>
                                    <input type="email" name="signupemail" id="signupemail" required="required" value="{{old('signupemail') != null ? old('signupemail') : ''}}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="signupname" class="active">Full name</label>
                                    <input type="text" name="signupname" id="signupname" required="required" value="{{old('signupname') != null ? old('signupname') : ''}}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="signupdob" class="active">Birthday</label>
                                    <input type="date" name="signupdob" id="signupdob" value="{{old('signupdob') != null ? old('signupdob') : ''}}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="signupphone" class="active">Mobile phone</label>
                                    <input type="text" name="signupphone" id="signupphone" value="{{old('signupphone') != null ? old('signupphone') : ''}}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="signuppassword" class="active">Password</label>
                                    <input type="password" name="signuppassword" id="signuppassword" required="required" minlength="8" value="{{old('signuppassword') != null ? old('signuppassword') : ''}}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="signupconfirmpassword" class="active">Confirm Password</label>
                                    <input type="password" name="signupconfirmpassword" id="signupconfirmpassword" required="required" minlength="8" value="{{old('signupconfirmpassword') != null ? old('signupconfirmpassword') : ''}}" autocomplete="off">
                                </div>

                                @if(session('signupErrorMessage'))
                                <span class="error">
                                    {{session('signupErrorMessage')}}
                                </span>
                                @endif

                                <div class="CTA">
                                    <div style="display: flex; justify-content: space-between;">
                                        <a href="#" class="switch signup-btn" style="text-decoration: none; color: white;"><i class="fa fa-chevron-left" aria-hidden="true"></i> Sign In</a>
                                        <button type="submit" class="submit-form-btn">Sign Up</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>

    <footer style="background: #fcfcfc; position: absolute; bottom: 0px; width: 100%; background: rgba(0, 0, 0, 0.85); color: whitesmoke; vertical-align: middle;">
        <div class="footer-bottom" style="margin-top:10px;">
            <p>Copyright &copy Cera Tiles Company LTD. </p>
        </div>
    </footer>

</body>

</html>


<script>
    $(document).ready(function() {

        'use strict';

        $('a.switch').click(function(e) {
            $(this).toggleClass('active');

            if ($('a.switch').hasClass('active')) {
                $(this).parents('.form-peice').addClass('switched').siblings('.form-peice').removeClass('switched');
            } else {
                $(this).parents('.form-peice').removeClass('switched').siblings('.form-peice').addClass('switched');
            }
        });

        $('input').focus(function() {

            $(this).siblings('label').addClass('active');
        });



        // Selecting all required elements
        const wrapper = document.querySelector(".toast-wrapper"),
            toast = wrapper.querySelector(".toast"),
            title = toast.querySelector("span"),
            subTitle = toast.querySelector("p"),
            wifiIcon = toast.querySelector(".icon"),
            closeIcon = toast.querySelector(".close-icon");

        window.onload = () => {
            function ajax() {
                closeIcon.onclick = () => { //hide toast notification on close icon click
                    wrapper.classList.add("hide");
                }
                setTimeout(() => { //hide the toast notification automatically after 5 seconds
                    wrapper.classList.add("hide");
                }, 5000);
            }

            function offline() { //function for offline
                wrapper.classList.remove("hide");
                toast.classList.add("offline");
                title.innerText = "You're offline now";
                subTitle.innerText = "Opps! Internet is disconnected.";
                wifiIcon.innerHTML = '<i class="uil uil-wifi-slash"></i>';
            }

            setInterval(() => { //this setInterval function call ajax frequently after 100ms
                ajax();
            }, 200);
        }


    });
</script>