@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a href="{{url('admin/product/productupsert')}}" class="btn rounded-pill btn-dark">Create New Product</a>
    </div>
    <div class="card">
        <h5 class="card-header">PRODUCTS</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr class="text-nowrap">
                        <th></th>
                        <th></th>
                        <th>Product Name</th>
                        <th>Selling Price</th>
                        <th>Origin</th>
                        <th>Material</th>
                        <th>Size</th>
                        <th>Application</th>
                        <th>Packingdetails</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('admin/product/productupsert/'.$product->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="{{url('admin/product/reviews/'.$product->id)}}"><i class="bx bx-chat me-1"></i> Reviews</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this product?');" href="{{url('admin/product/deleteproduct')}}/{{$product->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($product->mainimage == null || $product->mainimage == '')
                            <div class="avatar">
                                <img src="{{asset('guestasset')}}/img/product/noAvatar.jpg" alt="" class="w-px-50 h-auto">
                            </div>
                            @else
                            <div class="avatar">
                                <img src="{{asset('guestasset')}}/img/product/{{$product->mainimage}}" alt="" class="w-px-50 h-auto">
                            </div>
                            @endif
                        </td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->sellingprice}}</td>
                        <td>{{$product->origin}}</td>
                        <td>{{$product->material}}</td>
                        <td>{{$product->size}}</td>
                        <td>{{$product->application}}</td>
                        <td>{{$product->packingdetails}}</td>
                        <td>{{$product->remark}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#menu_product').addClass('active');
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