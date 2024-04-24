@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-secondary text-white" href="{{url('admin/product/productlist')}}">
            <span class="tf-icons bx bx-arrow-back"></span> Go back
        </a>
    </div>
    <div class="card mb-4">
        <form method="POST" action="{{url('/admin/product/productupsertpost')}}" enctype="multipart/form-data">
            @csrf
            <h5 class="card-header">{{isset($product) ? 'Revise Product'.$product->firstname.' '.$product->lastname.' Data' : 'Create New Product'}}</h5>
            <!-- Account -->
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{isset($product) ? asset('guestasset/img/product').'/'.$product->mainimage : asset('guestasset/img/product').'/ProductNoImage.png'}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">{{isset($product) ? 'Change Main Photo' : 'Upload Main Photo'}}</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" name="uploadmainpicture" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Remove</span>
                        </button>
                        <p class="text-muted mb-0">Allowed JPG, JPEG or PNG. Max size of 2MB</p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="mt-3 col-md-12">
                        <label for="relatedpictures" class="form-label">Other Images</label>
                        <input class="form-control" type="file" id="relatedpictures" name="relatedpictures[]" accept="image/png, image/jpeg" multiple>
                    </div>
                </div>
                <div class="row">
                    @if(isset($product))
                    @foreach($product->productimages as $image)
                    <div class="col-md-3 col-lg-2 mb-1">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{asset('guestasset')}}/img/product/{{$image->filename}}" alt="Card image cap">
                            <div class="card-body d-flex justify-content-center">
                                <a onclick="return confirm('Do you want to remove this image?');" href="{{url('/admin/product/removerelatedimage')}}/{{$image->id}}" class="btn btn-outline-primary">Remove</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
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
                            <input class="form-control" type="text" id="id" name="id" value="{{old('id') != null ? old('id') : (isset($product) ? $product->id : '')}}">
                        </div>
                    </div>


                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Product Name (*)</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{old('name') != null ? old('name') : (isset($product) ? $product->name : '')}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="subcategoryid " class="form-label">Category (*)</label>
                            <select id="subcategoryid" name="subcategoryid" class="select2 form-select">
                                <option value="">Select Role</option>
                                @foreach($categories as $category)
                                <optgroup label="{{$category->name}}">
                                    @foreach($category->subcategories as $item)
                                    @if(isset($product) && $item->id == $product->subcategoryid)
                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Description (*)</label>
                            <textarea class="form-control" type="text" id="description" name="description" required cols="30" rows="5">{{old('description') != null ? old('description') : (isset($product) ? $product->description : '')}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="sellingprice" class="form-label">Selling price (*)</label>
                            <input class="form-control" type="number" step="any" id="sellingprice" name="sellingprice" required value="{{old('sellingprice') != null ? old('sellingprice') : (isset($product) ? $product->sellingprice : '')}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="remark" class="form-label">Remark</label>
                            <input class="form-control" type="text" id="remark" name="remark" value="{{old('remark') != null ? old('remark') : (isset($product) ? $product->remark : '')}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="origin" class="form-label">Origin Country (*)</label>
                            <input class="form-control" type="text" id="origin" name="origin" required value="{{old('origin') != null ? old('origin') : (isset($product) ? $product->origin : '')}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="color" class="form-label">Color</label>
                            <input class="form-control" type="text" id="color" name="color" value="{{old('color') != null ? old('color') : (isset($product) ? $product->color : '')}}">
                        </div>

                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="material" class="form-label">Material</label>
                            <input class="form-control" type="text" id="material" name="material" value="{{old('material') != null ? old('material') : (isset($product) ? $product->material : '')}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="application" class="form-label">Application</label>
                            <input class="form-control" type="text" id="application" name="application" value="{{old('application') != null ? old('application') : (isset($product) ? $product->application : '')}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="size" class="form-label">Size</label>
                            <input class="form-control" type="text" id="size" name="size" value="{{old('size') != null ? old('size') : (isset($product) ? $product->size : '')}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="packingdetails" class="form-label">Packing Details</label>
                            <input class="form-control" type="text" id="packingdetails" name="packingdetails" value="{{old('packingdetails') != null ? old('packingdetails') : (isset($product) ? $product->packingdetails : '')}}">
                        </div>
                    </div>


                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">{{isset($product) ? 'Save Changes' : 'Create'}}</button>
                    </div>
                </div>
            </div>
            <!-- /Account -->
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#menu_product').addClass('active');
    });
</script>

@endsection