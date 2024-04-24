@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-dark" style="color: white;" href="{{url('/admin/upsertvoucher')}}">Create New Voucher</a>
    </div>
    <div class="card">
        <h5 class="card-header">VOUCHER</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Type</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Valid From</th>
                        <th>Valid To</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($vouchers as $voucher)
                    <tr id="tablerow_{{$voucher->id}}">
                        <td>
                            <div class="dropdown" id="dropdown_{{$voucher->id}}">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('/admin/upsertvoucher')}}/{{$voucher->id}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this delivery fee?');" href="{{url('admin/deletedeliveryfee')}}/{{$voucher->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                            <div class="spinner-border spinner-border-sm text-primary" role="status" id="spiner_{{$voucher->id}}" hidden>
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                        <td>{{$voucher->type}}</td>
                        <td><strong>{{$voucher->vouchercode}}</strong></td>
                        <td>{{$voucher->description}}</td>
                        <td>{{$voucher->quantity}}</td>
                        <td>{{date('m/d/Y', strtotime($voucher->validfrom))}}</td>
                        <td>{{date('m/d/Y', strtotime($voucher->validto))}}</td>
                        <td>{{$voucher->createdat}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#menu_feeandvoucher').addClass('active');
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