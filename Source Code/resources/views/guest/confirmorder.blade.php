@extends('layout.guestlayout')

@section('mainbody')

<?php $shoppingCart = session('shoppingcart'); ?>
<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <div class="discount__content mb-4">
            <div class="col-lg-8">
                <form action="{{url('product/applyvoucher')}}" method="POST" class="checkout__form" style="width: 100%;">
                    @csrf
                    <input type="text" placeholder="Enter your voucher code" id="vouchercode" name="vouchercode">
                    <button type="submit" class="site-btn">Apply</button>
                </form>
            </div>
        </div>

        <form action="{{url('payment/checkout')}}" method="post" class="checkout__form">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <h5>Delivery detail</h5>
                    @if ($errors->any())
                    <div class="row">
                        <div class="alert alert-danger" style="width: 100%;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Full Name <span>*</span></p>
                                <input type="text" require="required" name="fullname" value="{{old('fullname') != null ? old('fullname') : ''}}" style="border-radius: 5px; border-color:#aeb0af;">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="checkout__form__input" style="margin-bottom:20px;">
                                <p>Delivery Area <span>*</span></p>

                                <div class="spinner-border spinner-border-sm" role="status" id="spinerloading" hidden>
                                    <span class="visually-hidden"></span>
                                </div>

                                <style>
                                    .select2-selection__rendered {
                                        line-height: 50px !important;
                                    }

                                    .select2-container .select2-selection--single {
                                        height: 50px !important;
                                    }

                                    .select2-selection__arrow {
                                        height: 50px !important;
                                    }
                                </style>

                                <select id="deliveryarea" name="deliverycost" style="width: 100%; height:60px;">
                                    @if(isset($deliverycost))
                                    @foreach($deliverycost as $item)
                                    @if(isset($shoppingCart['delivery']))
                                    @if($shoppingCart['delivery']['id'] == $item->id)
                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                    @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="checkout__form__input">
                                <p>Address <span>*</span></p>
                                <input type="text" require="required" name="address" value="{{old('address') != null ? old('address') : ''}}" style="border-radius: 5px; border-color:#aeb0af;">
                            </div>

                            <div class="checkout__form__input">
                                <p>Phone <span>*</span></p>
                                <input type="text" require="required" name="phone" value="{{old('phone') != null ? old('phone') : ''}}" style="border-radius: 5px; border-color:#aeb0af;">
                            </div>

                            <div class="checkout__form__input">
                                <p>Email <span>*</span></p>
                                <input type="email" require="required" name="email"  value="{{old('email') != null ? old('email') : ''}}" style="border-radius: 5px; border-color:#aeb0af;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout__order" id="checkout_area">
                        <h5>Your order</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Product</span>
                                    <span class="top__text__right">Total</span>
                                </li>
                                @if(session('shoppingcart'))
                                <?php $shoppingCart = session('shoppingcart'); ?>
                                @foreach($shoppingCart['products'] as $item)
                                <li>{{$item['productname']}} (x{{$item['quantity']}}) <span>$ {{$item['itemamount']}}</span></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Subtotal <span>$ {{isset($shoppingCart['subtotalamount'])? $shoppingCart['subtotalamount']: 0}}</span></li>
                                <li>Voucher <span>- $ {{isset($shoppingCart['voucher'])? $shoppingCart['voucher']['amount'] : 0}}</span></li>
                                @if(isset($shoppingCart['voucher']))
                                <div style="text-align: left;">
                                    <span style="font-size: 12px;">
                                        {{$shoppingCart['voucher']['code']}}<a onclick="return confirm('Do you want to remove voucher?');" href="{{url('product/removevoucher')}}">(Remove)</a></br>
                                        -{{$shoppingCart['voucher']['type']}}-</br>
                                    </span>
                                </div>
                                @endif
                                <li>Delivery <span id="deliverycost">+ $ {{isset($shoppingCart['delivery'])? $shoppingCart['delivery']['amount'] : 0}}</span></li>
                                <li>Total <span id="grandtotal">$ {{isset($shoppingCart['grandtotalamount']) ? $shoppingCart['grandtotalamount'] : 0}}</span></li>
                            </ul>
                        </div>
                        <button type="submit" class="site-btn">Place oder</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</section>
<!-- Checkout Section End -->

<script>
    $(document).ready(function() {
        $('#deliveryarea').select2();
    });

    $('#deliveryarea').on('change', function() {
        showSpiner();
        var deliveryid = $(this).val();
        $.ajax({
            type: "GET",
            url: "/product/getdeliverycost/" + deliveryid,
            success: function(response) {
                $('#deliverycost').html('+ $ ' + response.deliverycost);
                $('#grandtotal').html('$ ' + response.newamount);
                hideSpiner();
            },
            error: function(response) {
                alert('Error: ' + response.message);
                hideSpiner();
            }
        });
    });


    function showSpiner() {
        $('#deliveryarea').attr("hidden", true);
        $('#spinerloading').attr("hidden", false);
        $("#checkout_area").attr("hidden", true);
    }

    function hideSpiner() {
        $('#deliveryarea').attr("hidden", false);
        $('#spinerloading').attr("hidden", true);
        $("#checkout_area").attr("hidden", false);
    }
</script>

@endsection