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
<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">



        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>Categories</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div>
                                        <a href="{{url('/product/listproduct')}}" style="color: black; font-size:11px;"><h6>All</h6></a>
                                    </div>
                                </div>
                                @foreach($categories as $category)
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapse{{ $category->id }}">{{ $category->name }}</a>
                                    </div>
                                    <div id="collapse{{ $category->id }}" class="collapse" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <ul>
                                                @foreach($category->subcategories as $sub)
                                                <li><a href="{{url('/product/listproduct?subcategoryid='.$sub->id)}}">{{ $sub->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="sidebar__filter">
                        <div class="section-title">
                            <h4>Filter by price</h4>
                        </div>
                        <div class="filter-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="{{$minselling}}" data-max="{{$maxselling}}"></div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount" style="text-align: center;">
                                    -
                                    <input type="text" id="maxamount"style="text-align: center;">
                                </div>
                            </div>
                        </div>
                        <br></br>
                        <a href="" id="filterBtn" style="width: 100%;">Filter</a>
                    </div>

                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="container search">
                    <style>
                        #searchForm {
                            width: 100%;
                        }

                        .search input {
                            height: 45px;
                            width: 90%;
                            padding-left: 20px;
                            font-size: 14px;
                            color: #444444;
                            border: 1px solid #e1e1e1;
                            border-radius: 10px;
                            margin: 20px 10px 20px 0;
                        }
                    </style>
                    <div style="display: flex; justify-content: center;">
                        <form id="searchForm" action="{{url('product/listproduct')}}" method="get">
                            <input type="text" name="searchtext" placeholder="Search..." value="">
                            <span class="icon_search" onclick="document.getElementById('searchForm').submit();"></span>
                        </form>
                    </div>

                </div>
                <div class="row">

                    @if(isset($products))
                    @if($products->count() >0)
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{asset('guestasset')}}/img/product/{{$product->mainimage}}">
                                <ul class="product__hover">
                                    <li><a href="{{asset('guestasset')}}/img/product/{{$product->mainimage}}" class="image-popup" title="Zoom in"><span class="arrow_expand"></span></a></li>
                                    <li>
                                        <a onclick="addtocompare('{{$product->id}}');" title="Add to comparison" id="addtoconmparebutton_{{$product->id}}"><span class="icon_balance"></span></a>
                                        <a class="spinner-border spinner-border-sm" style="color: white;" role="status" id="comparespiner_{{$product->id}}" hidden>
                                            <span class="visually-hidden"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="addtocart('{{$product->id}}');" id="addtocartbutton_{{$product->id}}" title="Add to cart">
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
                    @else
                    <div class="col-lg-12 col-md-12 mt-3" style="display: flex; justify-content: center;"><span>There is 0 item(s)</span></div>
                    @endif

                    @endif
                
                    {{ $products->appends(request()->query())->links('custom.pagination') }}

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->




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

    $('#filterBtn').on('click', function(e) {
        e.preventDefault();
        var minPrice = $('#minamount').val().replace('$', '');
        var maxPrice = $('#maxamount').val().replace('$', '');
        minPrice = minPrice !== '' ? minPrice : '0';
        maxPrice = maxPrice !== '' ? maxPrice : '0';
        var newUrl = window.location.protocol + "//" +
            window.location.host + window.location.pathname + '?min=' + minPrice + '&max=' + maxPrice;
        window.location.href = newUrl;
    });
</script>




@endsection