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
                                        <a href="#">My purchasing history</a>
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

                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>Full name</th>
                                    <th>Phone</th>
                                    <th>Transaction ID</th>
                                    <th>Total</th>
                                    <th>Paid At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myorders as $myorder)
                                <tr>
                                    <td>
                                        <div class="cart__product__item__title">
                                            <h6>{{$myorder->fullname}}</h6>
                                        </div>
                                    </td>
                                    <td><span>{{$myorder->phone}}</span></td>
                                    <td>{{$myorder->transactionid}}</td>
                                    <td class="cart__total">$ {{$myorder->grandtotalamount}}</td>
                                    <td>{{$myorder->completepaymentat}}</td>
                                    <td class="cart__close"><a href="{{url('payment/myorderdetails')}}/{{$myorder->id}}"><span>></span></a></td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection