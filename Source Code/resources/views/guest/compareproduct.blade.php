@extends('layout.guestlayout')

@section('mainbody')

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    @if(session()->has('comparecart'))
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <tr style="text-align: center;">
                            <th scope="col"></th>
                            @foreach($compareProducts as $product)
                            <th>
                                <img src="{{asset('guestasset')}}/img/product/{{$product->mainimage}}" alt="Not found" style="width: 120px; border-radius: 10px;">
                                </br>
                                <a onclick="return confirm('Do you want to remove it?');" href="{{url('product/removefromcompare')}}/{{$product->id}}" class="btn" style="color: red;">Remove</a>
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(['name','sellingprice','origin','color','material','size','application','packingdetails'] as $attribute)
                        <tr>
                            <td>{{ ucfirst($attribute) }}</td>
                            @foreach($compareProducts as $product)
                            <td style="text-align: center;">{{ $product->$attribute }}</td>
                            @endforeach
                        </tr>
                        @endforeach



                    </tbody>
                </table>

                <!-- <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Origin</th>
                            <th scope="col">Color</th>
                            <th scope="col">Material</th>
                            <th scope="col">Size</th>
                            <th scope="col">Application</th>
                            <th scope="col">Packing</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($compareProducts))
                        @foreach($compareProducts as $product)
                        <tr>
                            <td class="align-middle"><a onclick="return confirm('Do you want to remove it?');" href="{{url('product/removefromcompare')}}/{{$product->id}}"><span class="icon_close" style="color: red;"></span></a></td>
                            <td class="align-middle">
                                <img src="{{asset('guestasset')}}/img/product/{{$product->mainimage}}" alt="Not found" style="width: 120px; border-radius: 10px;">
                            </td>
                            <td class="align-middle">{{$product->name}}</td>
                            <td class="align-middle">{{$product->sellingprice}}</td>
                            <td class="align-middle">{{$product->origin}}</td>
                            <td class="align-middle">{{$product->color}}</td>
                            <td class="align-middle">{{$product->material}}</td>
                            <td class="align-middle">{{$product->size}}</td>
                            <td class="align-middle">{{$product->application}}</td>
                            <td class="align-middle">{{$product->packingdetails}}</td>
                        </tr>
                        @endforeach
                        @endif


                    </tbody>
                </table> -->
            </div>
        </div>
    </div>
    @else
    <div class="row" style="display: flex; justify-content:center;">
        <h6>There is no product to compare!</h6>
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
</script>




@endsection