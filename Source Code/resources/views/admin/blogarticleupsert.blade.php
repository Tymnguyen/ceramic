@extends('layout.adminlayout')

@section('mainbody')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-secondary text-white" href="{{url('admin/blogarticle')}}">
            <span class="tf-icons bx bx-arrow-back"></span> Go back
        </a>
    </div>
    <div class="card mb-4">
        <form method="POST" action="{{url('/admin/upsertblogarticlepost')}}" enctype="multipart/form-data">
            @csrf
            <h5 class="card-header">{{isset($blogarticle) ? 'REVISE ARTICLE' : 'CREATE ARTICLE'}}</h5>
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
                            <input class="form-control" type="text" id="id" name="id" value="{{old('id') != null ? old('id') : (isset($blogarticle) ? $blogarticle->id : '')}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="name" class="form-label">Article Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{old('name') != null ? old('name') : (isset($blogarticle) ? $blogarticle->name : '')}}">
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{isset($employee) ? asset('adminasset/img/avatars').'/'.$employee->profilepicture : asset('guestasset/img/product').'/ProductNoImage.png'}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">{{isset($employee) ? 'Change Profile Photo' : 'Upload Cover Photo'}}</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="uploadcoverpicture" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Remove</span>
                                </button>
                                <p class="text-muted mb-0">Allowed JPG, JPEG or PNG. Max size of 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <input class="form-control" type="text" id="description" name="description" value="{{old('description') != null ? old('description') : (isset($blogarticle) ? $blogarticle->description : '')}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="blogcategoryid  " class="form-label">Blog Category</label>
                            <select id="blogcategoryid " name="blogcategoryid" class="select2 form-select">
                                <option value="">Select Categoty</option>
                                @foreach($blogcategories as $blogcategory)
                                @if(old('blogcategoryid') != null)
                                @if(old('blogcategoryid') == $blogcategory->id)
                                <option value="{{$blogcategory->id}}" selected>{{$blogcategory->name}}</option>
                                @else
                                <option value="{{$blogcategory->id}}">{{$blogcategory->name}}</option>
                                @endif
                                @elseif(isset($blogarticle))
                                @if($blogarticle->blogcategoryid == $blogcategory->id)
                                <option value="{{$blogcategory->id}}" selected>{{$blogcategory->name}}</option>
                                @else
                                <option value="{{$blogcategory->id}}">{{$blogcategory->name}}</option>
                                @endif
                                @else
                                <option value="{{$blogcategory->id}}">{{$blogcategory->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row" hidden>
                        <div class="mb-3 col-md-12">
                            <label for="content" class="form-label">Blog Content</label>
                            <input class="form-control" type="text" id="quill_html" name="content" value="{{old('content') != null ? old('content') : (isset($blogarticle) ? $blogarticle->content : '')}}">
                        </div>
                    </div>
                    <div style="margin-bottom: 20px; min-height:200px;">
                        <div class="mb-3 col-md-12">
                            <div id="toolbar-container">
                                <span class="ql-formats">
                                    <select class="ql-font"></select>
                                    <select class="ql-size"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                    <button class="ql-strike"></button>
                                </span>
                                <span class="ql-formats">
                                    <select class="ql-color"></select>
                                    <select class="ql-background"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-script" value="sub"></button>
                                    <button class="ql-script" value="super"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-header" value="1"></button>
                                    <button class="ql-header" value="2"></button>
                                    <button class="ql-blockquote"></button>
                                    <button class="ql-code-block"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-list" value="ordered"></button>
                                    <button class="ql-list" value="bullet"></button>
                                    <button class="ql-indent" value="-1"></button>
                                    <button class="ql-indent" value="+1"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-direction" value="rtl"></button>
                                    <select class="ql-align"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-link"></button>
                                    <button class="ql-image"></button>
                                    <button class="ql-video"></button>
                                    <button class="ql-formula"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-clean"></button>
                                </span>
                            </div>
                            <div id="editor">
                                {{isset($blogarticle) ? $blogarticle->content : ''}}
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">{{isset($blogarticle) ? 'Save Changes' : 'Create'}}</button>
                    </div>
                </div>
            </div>
            <!-- /Account -->
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>

<script>
    $(document).ready(function() {
        $('#menu_blog').addClass('active');
    });

    var toolbarOptions = [
        // Other toolbar options
        ['font', {
            'font': ['Arial', 'Helvetica', 'Times New Roman', 'Courier New', 'Verdana', 'Roboto']
        }],
    ];

    const quill = new Quill('#editor', {
        modules: {
            syntax: true,
            toolbar: '#toolbar-container',
        },
        placeholder: 'Compose your blog here...',
        theme: 'snow',

    });

    // Set text for quill editor
    quill.root.innerHTML = document.getElementById("quill_html").value;

    quill.on('text-change', function(delta, oldDelta, source) {
        document.getElementById("quill_html").value = quill.root.innerHTML;
    });
</script>

@endsection