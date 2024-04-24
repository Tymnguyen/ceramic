@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <form method="POST" action="{{url('/admin/upsertcompanyinfo')}}" enctype="multipart/form-data">
            @csrf
            <h5 class="card-header">{{isset($companyinfo) ? 'REVISE COMPANY INFORMATION' : 'CREATE COMPANY INFORMATION'}}</h5>
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
                            <input class="form-control" type="text" id="id" name="id" value="{{old('id') != null ? old('id') : (isset($companyinfo) ? $companyinfo->id : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="name" class="form-label">Company Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{old('name') != null ? old('name') : (isset($companyinfo) ? $companyinfo->name : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{old('address') != null ? old('address') : (isset($companyinfo) ? $companyinfo->address : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="phone" class="form-label">Phone</label>
                            <input class="form-control" type="text" id="phone" name="phone" value="{{old('phone') != null ? old('phone') : (isset($companyinfo) ? $companyinfo->phone : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="fax" class="form-label">Fax</label>
                            <input class="form-control" type="text" id="fax" name="fax" value="{{old('fax') != null ? old('fax') : (isset($companyinfo) ? $companyinfo->fax : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{old('email') != null ? old('email') : (isset($companyinfo) ? $companyinfo->email : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input class="form-control" type="text" id="longitude" name="longitude" value="{{old('longitude') != null ? old('longitude') : (isset($companyinfo) ? $companyinfo->longitude : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input class="form-control" type="text" id="latitude" name="latitude" value="{{old('latitude') != null ? old('latitude') : (isset($companyinfo) ? $companyinfo->latitude : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="embedmapurl" class="form-label">Embed Map Url</label>
                            <input class="form-control" type="text" id="embedmapurl" name="embedmapurl" value="{{old('embedmapurl') != null ? old('embedmapurl') : (isset($companyinfo) ? $companyinfo->embedmapurl : '')}}">
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">{{isset($companyinfo) ? 'Save Changes' : 'Create'}}</button>
                    </div>
                </div>
            </div>
            <!-- /Account -->
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#menu_company').addClass('active');
    });
</script>

@endsection