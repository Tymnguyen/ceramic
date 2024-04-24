@extends('layout.guestlayout')

@section('mainbody')
<!-- Categories Section Begin -->
<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg" data-setbg="{{asset('guestasset')}}/img/banner/LuxuryDinningRoom.jpg">
                    <div class="categories__text" style="text-shadow: 0 0 5px white;">
                        <h1>Kitchen Tiles</h1>
                        <a href="{{url('product/listproduct?subcategoryid=2')}}">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{asset('guestasset')}}/img/banner/PublicArea.jpg">
                            <div class="categories__text" style="text-shadow: 0 0 5px white;">
                                <h4>Public Area Tiles</h4>
                                <a href="{{url('product/listproduct?subcategoryid=6')}}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{asset('guestasset')}}/img/banner/livingroom.jpg">
                            <div class="categories__text" style="text-shadow: 0 0 5px white;">
                                <h4>Living Room Tiles</h4>
                                <a href="{{url('product/listproduct?subcategoryid=4')}}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{asset('guestasset')}}/img/banner/Bathroom.jpg">
                            <div class="categories__text" style="text-shadow: 0 0 5px white;">
                                <h4>Bathroom Tiles</h4>
                                <a href="{{url('product/listproduct?subcategoryid=1')}}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{asset('guestasset')}}/img/banner/Bedroom.jpg">
                            <div class="categories__text" style="text-shadow: 0 0 5px white;">
                                <h4>Bedroom Tiles</h4>
                                <a href="{{url('product/listproduct?subcategoryid=5')}}">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New products</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">

            </div>
        </div>
        <div class="row property__gallery">
            @if(isset($newproducts))
            @foreach($newproducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{asset('guestasset')}}/img/product/{{$product->mainimage}}">
                        <div class="label new">New</div>
                        <ul class="product__hover">
                            <li><a href="{{asset('guestasset')}}/img/product/{{$product->mainimage}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li>
                                <a onclick="addtocompare('{{$product->id}}');" title="Add to comparison" id="addtoconmparebutton_{{$product->id}}"><span class="icon_balance"></span></a>
                                <a class="spinner-border spinner-border-sm" style="color: white;" role="status" id="comparespiner_{{$product->id}}" hidden>
                                    <span class="visually-hidden"></span>
                                </a>
                            </li>
                            <li>
                                <a onclick="addtocart('{{$product->id}}');" id="addtocartbutton_{{$product->id}}" title="Add to card">
                                    <span class="icon_bag_alt"></span>
                                </a>
                                <a class="spinner-border spinner-border-sm" style="color: white;" role="status" id="spiner_{{$product->id}}" hidden>
                                    <span class="visually-hidden"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{url('/product/productdetails')}}/{{$product->id}}">{{$product->name}}</a></h6>
                        <div class="product__price">$ {{$product->sellingprice}}</div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif


        </div>
    </div>
</section>
<!-- Product Section End -->


<script>
    function zoomElement(elementid) {
        const element = document.getElementById(elementid);
        element.classList.add('zoom');
    }

    function removeZoomElement(elementid) {
        const element = document.getElementById(elementid);
        element.classList.remove('zoom');
    }

    function addtocompare(id) {
        showCompareSpiner(id);
        $.ajax({
            type: "GET",
            url: "/product/addtocompare/" + id,
            success: function(response) {
                $('#comparebag_quantity1').html(response);
                $('#comparebag_quantity2').html(response);
                zoomElement('comparebag_quantity2');
                setTimeout(() => {
                    removeZoomElement('comparebag_quantity2');
                }, 1500);
                hideCompareSpiner(id);
            },
            error: function(response) {
                alert('Error: ' + response.message);
                hideCompareSpiner(id);
            }
        });
    }


    function addtocart(id) {
        showSpiner(id);
        $.ajax({
            type: "GET",
            url: "/product/addtocart/" + id,
            success: function(response) {
                $('#bag_quantity1').html(response);
                $('#bag_quantity2').html(response);
                zoomElement('bag_quantity2');
                setTimeout(() => {
                    removeZoomElement('bag_quantity2');
                }, 1500);
                hideSpiner(id);
            },
            error: function(response) {
                alert('Error: ' + response.message);
                hideSpiner(id);
            }
        });
    }

    function showSpiner(id) {
        $('#addtocartbutton_' + id).attr("hidden", true);
        $('#spiner_' + id).attr("hidden", false);
    }

    function hideSpiner(id) {
        $('#addtocartbutton_' + id).attr("hidden", false);
        $('#spiner_' + id).attr("hidden", true);
    }

    function showCompareSpiner(id) {
        $('#addtoconmparebutton_' + id).attr("hidden", true);
        $('#comparespiner_' + id).attr("hidden", false);
    }

    function hideCompareSpiner(id) {
        $('#addtoconmparebutton_' + id).attr("hidden", false);
        $('#comparespiner_' + id).attr("hidden", true);
    }
</script>

@endsection