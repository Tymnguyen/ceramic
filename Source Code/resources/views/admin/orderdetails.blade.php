@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-secondary text-white" href="{{url('admin/order/orderlist')}}">
            <span class="tf-icons bx bx-arrow-back"></span> Go back
        </a>
    </div>
    <div class="card">
        <h5 class="card-header">ORDER DETAILS</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th></th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($orderdetails as $item)
                    @if($item->type == 'Product')
                    <tr>
                        <td>{{$item->type}}</td>
                        <td>{{$item->product->name}}</td>
                        <td>
                            <div class="avatar">
                                <img src="{{asset('guestasset')}}/img/product/{{$item->product->mainimage}}" alt="" class="w-px-50 h-auto">
                            </div>
                        </td>
                        <td>$ {{$item->product->sellingprice}}</td>
                        <td>{{$item->quantity}}</td>
                        <td class="cart__total">$ {{$item->amount}}</td>
                    </tr>
                    @elseif($item->type == 'Delivery')
                    <tr>
                        <td>{{$item->type}}</td>
                        <td>{{$item->delivery->name}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="cart__total">$ {{$item->amount}}</td>

                    </tr>
                    @else
                    <tr>
                        <td>{{$item->type}}</td>
                        <td>{{$item->voucher->vouchercode}}</td>
                        <td></td>
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



<script>
    $(document).ready(function() {
        $('#menu_order').addClass('active');
        $('#dataTable').DataTable({
            "pageLength": 10,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    });
</script>

@endsection