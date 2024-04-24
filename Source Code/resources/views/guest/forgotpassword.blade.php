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
    @if (session('signupSuceessMessage'))
    <div class="toast-wrapper">
        <div class="toast" style="border-left: 5px solid #2ecc71;">
            <div class="content">
                <div class="icon" style="background: #2ecc71;"><i class="fa fa-check"></i></div>
                <div class="details">
                    <span>Success</span>
                    <p>{{ session('signupSuceessMessage') }}</p>
                </div>
            </div>
            <div class="close-icon"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
    </div>
    @endif

    @if (session('signinErrorMessage'))
    <div class="toast-wrapper">
        <div class="toast" style="border-left: 5px solid #e43333;">
            <div class="content">
                <div class="icon" style="background: #e43333;"><i class="fa fa-check"></i></div>
                <div class="details">
                    <span>Error</span>
                    <p>{{session('signinErrorMessage')}}</p>
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
                        <div class="login form-peice">

                            @if (session('signinErrorMessage'))
                            <div class="d-flex justify-content-center mb-1">
                                <span class="badge bg-label-danger text-wrap" style="line-height: 1.5em;">{{ session('signinErrorMessage') }}</span>
                            </div>
                            @endif

                            <form class="login-form" id="loginform" action="{{url('/auth/sendresetpasswordtoken')}}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="resetemail">Email Adderss</label>
                                    <input type="email" name="resetemail" id="resetemail" required="required" value="">
                                </div>

                                <div class="CTA">
                                    <div style="display: flex; justify-content: space-between;">
                                        <a href="{{url('auth/login')}}" class="signup-btn" style="text-decoration: none; color: white; text-align: center;"><i class="fa fa-chevron-left" aria-hidden="true"></i> Go to Login</a>
                                        <button type="submit" class="submit-form-btn">Reset Password</button>
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
            }, 100);
        }


    });
</script>