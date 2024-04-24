@extends('layout.guestlayout')

@section('mainbody')

@if(isset($status))
@if($status === 'Success')
<section class="banner set-bg">
    <div class="container" style="margin-top: 60px;">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__item">
                    <div class="banner__text" style="text-align: center;">
                        <span style="color: green;">Thank you for using our services</span>
                        <h1>Payment Success</h1>
                        <i class="fa fa-check-circle" aria-hidden="true" style="color: green; font-size:60px;"></i>
                        <br><br />
                        <span style="color: green;">{!!$message!!}</span>
                        <br /><br />
                        <a href="{{url('/')}}">Back to main page</a>
                    </div>
                </div>
            </div>
        </div>
</section>

@else
<section class="banner set-bg">
    <div class="container" style="margin-top: 60px;">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__item">
                    <div class="banner__text" style="text-align: center;">
                        <span>Opps! Your payment is not success</span>
                        <h1 style="color: red;">Payment Error</h1>
                        <i class="fa fa-exclamation-circle" aria-hidden="true" style="color: red; font-size:60px;"></i>
                        <br><br />
                        <span>{!!$message!!}</span>
                        <br /><br />
                        <a href="{{url('/')}}">Back to main page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endif
@endif

@endsection