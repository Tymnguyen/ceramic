@extends('layout.guestlayout')

@section('mainbody')

<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>{{session('username')}}</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                @if(session()->has('accounttype') && session('accounttype')=='Registed')
                                <div class="card">
                                    <div>
                                        <a href="{{url('auth/myaccount')}}">Change Password</a>
                                    </div>
                                </div>
                                @endif
                                <div class="card">
                                    <div>
                                        <a href="{{url('/payment/myorders')}}">My purchasing history</a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div>
                                        <a href="{{url('auth/logout')}}">Log out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                @if(session()->has('accounttype') && session('accounttype')=='Registed')
                <form action="{{url('auth/changepassword')}}" method="POST" class="checkout__form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <h5>CHANGE PASSWORD</h5>
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(session('errorMessage'))
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger">
                                            <ul>
                                                <li>session('errorMessage')</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endif

                                    @if(session('successMessage'))
                                    <div class="col-lg-12">
                                        <div class="alert alert-success">
                                            <ul>
                                                <li>session('successMessage')</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($errors->any())
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="checkout__form__input">
                                        <p>Current Password <span></span></p>
                                        <input type="password" name="currentpassword" value="{{old('currentpassword') != null ? old('currentpassword') : ''}}">
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>New Password <span></span></p>
                                        <input type="password" name="newpassword" value="{{old('newpassword') != null ? old('newpassword') : ''}}" minlength="8" maxlength="50">
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>Confirm New Password <span></span></p>
                                        <input type="password" name="newpassword_confirmation" value="{{old('confirmnewpassword') != null ? old('confirmnewpassword') : ''}}" minlength="8" maxlength="50">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="site-btn">Change</button>
                                </div>
                            </div>
                        </div>
                </form>
                @endif



            </div>
        </div>
    </div>
</section>
@endsection