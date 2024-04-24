@extends('layout.guestlayout')

@section('mainbody')

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    @if(session()->has('shoppingcart'))
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(session()->has('shoppingcart'))
                            <?php $shoppingCart = session('shoppingcart'); ?>
                            @foreach($shoppingCart['products'] as $item)
                            <tr>
                                <td class="cart__product__item align-middle">
                                    <img src="{{asset('guestasset')}}/img/product/{{$item['mainimage']}}" alt="" style="width: 120px; border-radius: 10px;">
                                    <div class="cart__product__item__title">
                                        <h6>{{$item['productname']}}</h6>
                                    </div>
                                </td>
                                <td class="cart__price align-middle">$ {{$item['sellingprice']}}</td>
                                <td class="cart__quantity align-middle">

                                    <?php $id =  $item['productid'] ?>

                                    <div class="spinner-border spinner-border-sm" role="status" id="spiner_{{$item['productid']}}" hidden>
                                        <span class="visually-hidden"></span>
                                    </div>
                                    <div id="containerquantityof_{{$id}}" class="pro-qty" style="display: flex; align-items: center;">
                                        <!-- Assign quantity value to a variable to avoid quote conflict -->
                                        <input type="number" style="background-color: #F6EEE9; border-radius:10px; height: 2rem;" id="quantityof_{{$id}}" value="{{$item['quantity']}}" onchange="updatequantity('{{$id}}');">
                                    </div>
                                </td>
                                <td class="cart__total align-middle" id="subtotal_{{$id}}">$ {{$item['itemamount']}}</td>
                                <td class="cart__close align-middle"><a onclick="return confirm('Do you want to remove from your cart?');" href="{{url('product/removefromcart')}}/{{$item['productid']}}"><span class="icon_close"></span></a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-3">
            <div class="cart__total__procced" id="checkout_area">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Total <span id="total_amount">$ {{$shoppingCart['subtotalamount']}}</span></li>
                    </ul>
                    <a href="{{url('product/confirmorder')}}" class="primary-btn" style="text-decoration: none; color: white;">Checkout</a>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    </div>
    @else
    <div class="row" style="display: flex; justify-content:center;">
        <h6>Your cart is empty, please select item to add in cart. Happy shopping!</h6>
    </div>
    @endif

</section>

<!-- Shop Cart Section End -->


<script>
    function updatequantity(id) {
        showSpiner(id);
        var quantity = $('#quantityof_' + id).val();
        $.ajax({
            type: "GET",
            url: "/product/revisecartquantity/" + id + "/" + quantity,
            success: function(response) {
                $(this).closest('.cart-item').find('.item-total').text()
                $('#quantityof_' + id).val(response.newquantity);
                $('#subtotal_' + id).html(response.newamount);
                $('#total_amount').html('$ ' + response.subtotalamount);
                hideSpiner(id);

            },
            error: function(response) {
                alert('Error: ' + response.message);
                hideSpiner(id);
            }
        });
    }

    function showSpiner(id) {
        $('#containerquantityof_' + id).attr("hidden", true);
        $('#spiner_' + id).attr("hidden", false);
        $("#checkout_area").attr("hidden", true);
    }

    function hideSpiner(id) {
        $('#containerquantityof_' + id).attr("hidden", false);
        $('#spiner_' + id).attr("hidden", true);
        $("#checkout_area").attr("hidden", false);
    }
</script>




@endsection