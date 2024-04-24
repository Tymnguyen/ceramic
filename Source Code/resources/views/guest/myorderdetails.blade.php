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

                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th></th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myorderdetails as $item)
                                @if($item->type == 'Product')
                                <tr>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td><img src="{{asset('guestasset')}}/img/product/{{$item->product->mainimage}}" alt="" style="width: 120px; border-radius: 10px;"></td>
                                    <td class="cart__total">$ {{$item->amount}}</td>
                                </tr>
                                @elseif($item->type == 'Delivery')
                                <tr>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->delivery->name}}</td>
                                    <td></td>
                                    <td></td>
                                    <td class="cart__total">$ {{$item->amount}}</td>
                                </tr>
                                @else
                                <tr>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->voucher->name}}</td>
                                    <td></td>
                                    <td></td>
                                    <td class="cart__total">- $ {{$item->amount}}</td>
                                </tr>
                                @endif

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection