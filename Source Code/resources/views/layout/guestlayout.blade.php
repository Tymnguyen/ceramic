<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cera">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cera Tiles</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('adminasset')}}/img/logo/cera_golden_logo.png" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('guestasset')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('guestasset')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('guestasset')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('guestasset')}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('guestasset')}}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{asset('guestasset')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('guestasset')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('guestasset')}}/css/style.css" type="text/css">
    <link rel="stylesheet" href="{{asset('guestasset')}}/js/select2/select2.min.css" type="text/css">
    <script src="{{asset('guestasset')}}/js/jquery-3.6.0.min.js"></script>
    <script src="{{asset('guestasset')}}/js/select2/select2.min.js"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader">

        </div>
    </div>





    @if(session('successMessage'))
    <div class="toast show" role="alert" id="SuccessToast" aria-live="assertive" aria-atomic="true" style="position: fixed; z-index:1000; bottom: 0; right: 0; min-width:400px;">
        <div class="toast-header" style="color: green;">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <strong class="mr-auto" style="margin-left: 10px;">Success</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" onclick="$('#SuccessToast').toast('hide');">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body">
            {{session('successMessage')}}
        </div>
    </div>
    @endif

    @if(session('warningMessage'))
    <div class="toast show" role="alert" id="WarningToast" aria-live="assertive" aria-atomic="true" style="position: fixed; z-index:1000; bottom: 0; right: 0; min-width:400px;">
        <div class="toast-header" style="color: #f4bc1c;">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <strong class="mr-auto" style="margin-left: 10px;">Warning</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" onclick="$('#WarningToast').toast('hide');">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body">
            {{session('warningMessage')}}
        </div>
    </div>
    @endif

    @if(session('errorMessage'))
    <div class="toast show" role="alert" id="AlertToast" aria-live="assertive" aria-atomic="true" style="position: fixed; z-index:1000; bottom: 0; right: 0; min-width:400px;">
        <div class="toast-header" style="color: red;">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <strong class="mr-auto" style="margin-left: 10px;">Alert</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" onclick="$('#AlertToast').toast('hide');">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body">
            {{session('errorMessage')}}
        </div>
    </div>
    @endif





    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>

        <div class="offcanvas__logo">
            <div class="header__logo" style="display: flex; justify-content: left; align-items: center; padding: 0px;">
                <a href="{{url('/')}}"><img src="{{asset('guestasset')}}/img/logo/cera_golden_logo.png" alt="" width="40"></a>
                <h6><a href="{{url('/')}}" style="text-decoration: none; color:black;"><b>CERA TILES</b></a></h6>
            </div>
        </div>
        <ul class="offcanvas__widget" style="display: flex; justify-content: left; align-items: center;">
            <li><span class="icon_search search-switch"></span></li>
            <li>
                <a href="{{url('product/compareproducts')}}"><span class="icon_balance"></span>
                    <div class="tip" id="comparebag_quantity1">
                        @if(session()->has('comparecart'))
                        <?php $compareCart = session('comparecart'); ?>
                        {{count($compareCart['products'])}}
                        @else
                        0
                        @endif
                    </div>
                </a>
            </li>
            <li>
                <a href="{{url('product/shoppingcart')}}" id="bag_container1" class="shake"><span class="icon_bag_alt"></span>
                    <div class="tip" id="bag_quantity1">
                        @if(session()->has('shoppingcart'))
                        <?php $shoppingCart = session('shoppingcart'); ?>
                        {{count($shoppingCart['products'])}}
                        @else
                        0
                        @endif
                    </div>
                </a>
            </li>
            <li>
                @if(session()->has('userid'))
                @if(session('avartar') != null && session('avartar') != '')
                <a href="{{url('/auth/myaccount')}}">
                    <img src="{{session('avartar')}}" alt="" width="30" style="border-radius: 50%; margin-bottom:12px;">
                </a>
                @else
                <a href="{{url('/auth/myaccount')}}">
                    <img src="{{asset('guestasset')}}/img/noAvatar.jpg" alt="" width="30" style="border-radius: 50%; margin-bottom:12px;">
                </a>
                @endif
                @else
                <a href="{{url('/auth/login')}}" style=" margin-bottom:12px;">Login/Register</a>
                @endif
            </li>
        </ul>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo" style="display: flex; justify-content: left; align-items: center;">
                        <a href="{{url('/')}}"><img src="{{asset('guestasset')}}/img/logo/cera_golden_logo.png" alt="" width="40"></a>
                        <h6><a href="{{url('/')}}" style="text-decoration: none; color:black;"><b>CERA TILES</b></a></h6>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7" style="text-align:center;">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            @if(isset($menuItems))
                            @foreach($menuItems as $item)
                            <li><a href="{{url('product/listproduct')}}?categoryid={{$item->id}}">{{$item->name}}</a>
                                <ul class="dropdown">
                                    @foreach($item->subcategories as $subitem)
                                    <li><a href="{{url('product/listproduct')}}?subcategoryid={{$subitem->id}}">{{$subitem->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                            @endif
                            <li><a href="{{url('blog')}}">Blog</a></li>
                            <li><a href="{{url('ecatalogue')}}">E-Catalogue</a></li>
                            <li><a href="{{url('contact')}}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">

                        <ul class="header__right__widget" style="margin-right:20px;">
                            <!-- <li><span class="icon_search search-switch"></span></li> -->
                            <li>
                                <a href="{{url('product/compareproducts')}}" id="comparebag_container2">
                                    <span class="icon_balance"></span>
                                    <div class="tip" id="comparebag_quantity2">
                                        @if(session()->has('comparecart'))
                                        {{count($compareCart['products'])}}
                                        @else
                                        0
                                        @endif
                                    </div>
                                </a>

                            </li>
                            <li>
                                <a href="{{url('product/shoppingcart')}}" id="bag_container2">
                                    <span class="icon_bag_alt"></span>
                                    <div class="tip" id="bag_quantity2">
                                        @if(session()->has('shoppingcart'))
                                        {{count($shoppingCart['products'])}}
                                        @else
                                        0
                                        @endif
                                    </div>
                                </a>
                            </li>
                        </ul>

                        <div class="header__right__auth">

                            @if(session()->has('userid'))
                            <a href="{{url('/auth/myaccount')}}">
                                @if(session('avartar') != null && session('avartar') != '')
                                <img src="{{session('avartar')}}" alt="" width="30" style="border-radius: 50%; margin-bottom:12px;">
                                @else
                                <img src="{{asset('guestasset')}}/img/noAvatar.jpg" alt="" width="30" style="border-radius: 50%; margin-bottom:12px;">
                                @endif
                                <!-- <span>{{session('username')}}</span> -->
                            </a>
                            @else
                            <a href="{{url('/auth/login')}}" style="margin-bottom:12px;">Login/Register</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    <!-- Main body Section Begin -->
    @yield('mainbody')
    <!-- Main body Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="{{url('/')}}"><img src="{{asset('guestasset')}}/img/logo/cera_golden_logo.png" alt="" width="60"></a>
                        </div>
                        <p>Cera Tiles is a leading provider of high-quality ceramic and porcelain tiles, renowned for its innovation, craftsmanship, and commitment to excellence.</p>
                        <div class="footer__payment">
                            <a><img src="{{asset('guestasset')}}/img/payment/payment-1.png" alt=""></a>
                            <a><img src="{{asset('guestasset')}}/img/payment/payment-2.png" alt=""></a>
                            <a><img src="{{asset('guestasset')}}/img/payment/payment-4.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="footer__widget">
                        <h6>Quick links</h6>
                        <ul>
                            <li><a href="{{url('contact')}}">About</a></li>
                            <li><a href="{{url('blog')}}">Blogs</a></li>
                            <li><a href="{{url('ecatalogue')}}">Catalogue</a></li>
                            <li><a href="{{url('contact')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="footer__widget">
                        <h6>Account</h6>
                        <ul>
                            <li><a href="{{url('auth/myaccount')}}">My Account</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-8">
                    <div class="footer__newslatter">
                        <h6>SOCIAL</h6>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <div class="footer__copyright__text">
                        <p>Copyright &copy; <script>
                                document.write(new Date().getFullYear());
                            </script>Cera Tiles Company All rights reserved</p>
                    </div>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->



    <!-- Js Plugins -->
    <!--  -->

    <script src="{{asset('guestasset')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('guestasset')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('guestasset')}}/js/jquery-ui.min.js"></script>
    <script src="{{asset('guestasset')}}/js/mixitup.min.js"></script>
    <script src="{{asset('guestasset')}}/js/jquery.countdown.min.js"></script>
    <script src="{{asset('guestasset')}}/js/jquery.slicknav.js"></script>
    <script src="{{asset('guestasset')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('guestasset')}}/js/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{asset('guestasset')}}/js/main.js"></script>

</body>

</html>