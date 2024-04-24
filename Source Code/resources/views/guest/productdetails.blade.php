@extends('layout.guestlayout')

@section('mainbody')

<style>
    @keyframes zoom {
        0% {
            transform: scale(1);
        }

        /* Initial scale */
        50% {
            transform: scale(2);
            color: red;
        }

        /* Zoom in to 20% larger */
        100% {
            transform: scale(1);
        }

        /* Return to original scale */
    }

    /* Apply the animation to the element */
    .zoom {
        animation: zoom 1.5s;
    }
</style>


<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__left product__thumb nice-scroll">
                        <a class="pt active" href="#product--1">
                            <img src="{{asset('guestasset')}}/img/product/{{$product->mainimage}}" alt="">
                        </a>
                        @foreach($product->productimages as $relatedimage)
                        <a class="pt" href="#product-{{$relatedimage->id}}">
                            <img src="{{asset('guestasset')}}/img/product/{{$relatedimage->filename}}" alt="">
                        </a>
                        @endforeach
                    </div>
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-hash="product--1" class="product__big__img" src="{{asset('guestasset')}}/img/product/{{$product->mainimage}}" alt="">
                            @foreach($product->productimages as $relatedimage)
                            <img data-hash="product-{{$relatedimage->id}}" class="product__big__img" src="{{asset('guestasset')}}/img/product/{{$relatedimage->filename}}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h3>{{$product->name}} <span>Origin: {{$product->origin}}</span></h3>
                    <div class="product__details__price">$ {{$product->sellingprice}}</div>
                    <p>
                        Size: {{$product->size}}
                        <br>Material: {{$product->material}}
                        <br>Color: {{$product->color}}
                        <br>Application: {{$product->application}}
                    </p>
                    <div class="product__details__button">
                        <div class="quantity">
                            <span>Quantity:</span>
                            <div class="pro-qty">
                                <input type="text" id="cartquantity" value="1">
                            </div>
                        </div>
                        <a href="#" onclick="addtocart('{{$product->id}}');" class="cart-btn"><span class="icon_bag_alt"></span> Add to cart</a>
                        <ul>
                            <li>
                                <a href="#" onclick="addtocompare('{{$product->id}}');" title="Add to comparison" id="addtoconmparebutton_{{$product->id}}"><span class="icon_balance"></span></a>
                                <a class="spinner-border spinner-border-sm" style="border-color: red;" role="status" id="comparespiner_{{$product->id}}" hidden>
                                    <span class="visually-hidden"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product__details__widget">
                        <ul>
                            <li>
                                <span>Availability:</span>
                                <div class="stock__checkbox">
                                    <label for="stockin">
                                        In Stock
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <h6>Description</h6>
                            <p>{!! $product->description !!}</p>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <h6>Reviews ({{$reviews->count()}})</h6>

                            <div class="contact__form">
                                @if(session()->has('userid') && $alreadyboughtthisitem)
                                <form action="{{url('/product/productaddreview')}}" method="POST">
                                    @csrf
                                    <input type="text" name="id" value="{{$product->id}}" hidden>
                                    <textarea placeholder="Add your review..." style="height:100px;" name="commenttext"></textarea>
                                    <button type="submit" class="site-btn">Add Review</button>
                                </form>
                                @else
                                <form action="#" disabled>
                                    <textarea placeholder="Only user bought this product can review it..." style="height:100px;" disabled></textarea>
                                </form>
                                @endif
                            </div>

                            <div class="blog__details__comment" style="margin-top: 25px; max-height:500px; overflow:scroll;">

                                @if(isset($reviews))
                                @foreach($reviews as $review)
                                <div class="blog__comment__item">
                                    <div class="blog__comment__item__pic">
                                        <img src="{{$review->createby->avatar}}" alt="" style="width:80px;">
                                    </div>
                                    <div class="blog__comment__item__text">
                                        @if(session()->has('userid') && session('userid') == $review->createdby)
                                        <h6>{{$review->createby->fullname}} <a onclick="return confirm('Do you want to delete this review?');" href="{{url('/product/deletemyreview')}}/{{$review->id}}" style="color: red;">(Remove)</a></h6>
                                        @else
                                        <h6>{{$review->createby->fullname}}</h6>
                                        @endif
                                        
                                        <p>{{$review->commentcontent}}</p>
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i> {{$review->createdat}}</li>
                                        </ul>
                                    </div>
                                </div>

                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="related__title">
                    <h5>RELATED PRODUCTS</h5>
                </div>
            </div>

            @foreach($relatedproducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{asset('guestasset')}}/img/product/{{$product->mainimage}}">
                        <ul class="product__hover">
                            <li><a href="{{asset('guestasset')}}/img/product/{{$product->mainimage}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li>
                                <a onclick="addtocompare('{{$product->id}}');" title="Add to comparison" id="addtoconmparebutton_{{$product->id}}"><span class="icon_balance"></span></a>
                                <a class="spinner-border spinner-border-sm" style="color: white;" role="status" id="comparespiner_{{$product->id}}" hidden>
                                    <span class="visually-hidden"></span>
                                </a>
                            </li>
                            <li>
                                <a onclick="addtocart('{{$product->id}}');" id="addtocartbutton_{{$product->id}}" title="Add to cart"><span class="icon_bag_alt"></span></a>
                                <a class="spinner-border spinner-border-sm" style="color: white;" role="status" id="spiner_{{$product->id}}" hidden>
                                    <span class="visually-hidden"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">{{$product->name}}</a></h6>
                        <div class="product__price">$ {{$product->sellingprice}}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Product Details Section End -->


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
        var quantity = $('#cartquantity').val();
        $.ajax({
            type: "GET",
            url: "/product/addtocart/" + id + "/" + quantity,
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