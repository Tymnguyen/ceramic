@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-secondary text-white" href="{{url('admin/voucherlist')}}">
            <span class="tf-icons bx bx-arrow-back"></span> Go back
        </a>
    </div>
    <div class="card mb-4">
        <form method="POST" action="{{url('/admin/upsertvoucherpost')}}" enctype="multipart/form-data">
            @csrf
            <h5 class="card-header">{{isset($vouchers) ? 'Revise Voucher' : 'Create New Voucher'}}</h5>
            <hr class="my-0">
            <div class="card-body">
                <div id="formAccountSettings">

                    @if ($errors->any())
                    <div class="row">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="row" hidden>
                        <div class="mb-3 col-md-6">
                            <input class="form-control" type="text" id="id" name="id" value="{{old('id') != null ? old('id') : (isset($vouchers) ? $vouchers->id : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="type" class="form-label">Voucher Type</label>
                            <select id="type" name="type" class="select2 form-select">
                                <option value="Percentage discount on amount">Percentage discount on amount</option>
                                <option value="Fixed discount value">Fixed discount value</option>
                                <option value="Percentage discount on shipping">Percentage discount on shipping</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="vouchercode" class="form-label">Voucher Code</label>
                            <input class="form-control" type="text" name="vouchercode" id="vouchercode" value="{{old('vouchercode') != null ? old('vouchercode') : (isset($vouchers) ? $vouchers->vouchercode : '')}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{old('description') != null ? old('description') : (isset($vouchers) ? $vouchers->description : '')}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="value" class="form-label">Value</label>
                            <input class="form-control" type="number" name="value" id="value" value="{{old('value') != null ? old('value') : (isset($vouchers) ? $vouchers->value : '')}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input class="form-control" type="number" name="quantity" id="quantity" value="{{old('quantity') != null ? old('quantity') : (isset($vouchers) ? $vouchers->quantity : '')}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="validfrom" class="form-label">Valid From</label>
                            <input class="form-control" type="date" id="validfrom" name="validfrom" value="{{old('validfrom') != null ? old('validfrom') : (isset($vouchers) ? date('Y-m-d', strtotime($vouchers->validfrom)) : '')}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="validto" class="form-label">Valid To</label>
                            <input class="form-control" type="date" name="validto" id="validto" value="{{old('validto') != null ? old('validto') : (isset($vouchers) ? date('Y-m-d', strtotime($vouchers->validto)) : '')}}">
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">{{isset($vouchers) ? 'Save Changes' : 'Create'}}</button>
                    </div>
                </div>
            </div>
            <!-- /Account -->
        </form>
    </div>
</div>

@endsection