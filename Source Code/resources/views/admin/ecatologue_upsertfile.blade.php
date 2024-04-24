@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-secondary text-white" href="{{url('admin/ecataloguefilelist')}}">
            <span class="tf-icons bx bx-arrow-back"></span> Go back
        </a>
    </div>
    <div class="card mb-4">
        <form method="POST" action="{{url('/admin/ecataloguefileupsert_post')}}" enctype="multipart/form-data">
            @csrf
            <h5 class="card-header">{{isset($file) ? 'Revise File: '.$file->originalfilename : 'Upload New File'}}</h5>
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
                            <input class="form-control" type="text" id="id" name="id" value="{{old('id') != null ? old('id') : (isset($file) ? $file->id : '')}}">
                        </div>
                    </div>
  
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="uploadfile" class="form-label">Upload file</label>
                            <input class="form-control" type="file" id="uploadfile" name="uploadfile" >
                        </div>
                    </div>
      
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="categoryid " class="form-label">Category</label>
                            <select id="categoryid" name="categoryid" class="select2 form-select">
                                <option value="">Select Category</option>
                                @foreach($catagories as $catagory)
                                    @if(old('catalogueid') != null)
                                        @if(old('catalogueid') == $catagory->id)
                                        <option value="{{$catagory->id}}" selected>{{$catagory->name}}</option>
                                        @else
                                        <option value="{{$catagory->id}}">{{$catagory->name}}</option>
                                        @endif
                                    @elseif(isset($file))
                                        @if($file->catalogueid == $catagory->id)
                                        <option value="{{$catagory->id}}" selected>{{$catagory->name}}</option>
                                        @else
                                        <option value="{{$catagory->id}}">{{$catagory->name}}</option>
                                        @endif
                                    @else
                                        <option value="{{$catagory->id}}">{{$catagory->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="remark" class="form-label">Remark</label>
                            <input class="form-control" type="text" id="remark" name="remark" value="{{old('remark') != null ? old('remark') : (isset($employee) ? $employee->remark : '')}}">
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">{{isset($file) ? 'Save Changes' : 'Create'}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection