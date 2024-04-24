@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-secondary text-white" href="{{url('/admin/category/categorymain')}}">
            <span class="tf-icons bx bx-arrow-back"></span> Go back
        </a>
        <button type="button" class="btn rounded-pill btn-dark" onclick="create();">Create New Sub Category</button>
    </div>
    <div class="card">
        <h5 class="card-header">SUB CATEGORY</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Category</th>
                        <th>Sub Category name</th>
                        <th>Remark</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($subcategories as $subcategory)
                    <tr id="tablerow_{{$subcategory->id}}">
                        <td>
                            <div class="dropdown" id="dropdown_{{$subcategory->id}}">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="edit('{{$subcategory->id}}');"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this category?');" href="{{url('admin/category/deletesubcategory')}}/{{$subcategory->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                            <div class="spinner-border spinner-border-sm text-primary" role="status" id="spiner_{{$subcategory->id}}" hidden>
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{isset($subcategory->category) ? $subcategory->category->name : ''}}</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$subcategory->name}}</strong></td>
                        <td>{{$subcategory->remark}}</td>
                        <td>{{$subcategory->createdat}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
    <form method="POST" action="{{url('/admin/category/createsubcategory')}}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">New Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-3" hidden>
                            <label for="_id" class="form-label">Id</label>
                            <input type="text" id="_id" name="id" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="_category" class="form-label">Category</label>
                            <select class="form-select" id="_category" name="categoryid" required>
                                <option value="">Select Category</option>
                                @if(isset($categories))
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="_name" class="form-label">Sub Category Name</label>
                            <input type="text" id="_name" name="name" class="form-control" placeholder="Enter Sub Category Name" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="_remark" class="form-label">Remark</label>
                            <input type="text" id="_remark" name="remark" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitbutton">Create</button>
                </div>
            </div>
        </div>
    </form>

</div>



<script>
    $(document).ready(function() {
        $('#menu_category').addClass('active');
        $('#dataTable').DataTable({
            "pageLength": 10,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    });


    function create() {
        $('#backDropModalTitle').text('New Sub Category');
        $('#submitbutton').html('Create');
        $('#_id').val('');
        $('#_name').val('');
        $('#_remark').val('');
        $('#backDropModal').modal('toggle');
    };

    function edit(id) {
        showSpiner(id);
        $.ajax({
            type: "GET",
            url: "/admin/category/getsubcategory/" + id,
            success: function(response) {
                $('#backDropModalTitle').text('Edit Sub Category: ' + response.name);
                $('#submitbutton').html('Revise');
                $('#_id').val(response.id);
                $('#_category').val(response.categoryid);
                $('#_name').val(response.name);
                $('#_remark').val(response.remark);
                $('#backDropModal').modal('toggle')
                hideSpiner(id);
            },
            error: function(response) {
                alert('Error: ' + response);
                hideSpiner(id);
            }
        });
    }

    function showSpiner(id) {
        $('#dropdown_' + id).attr("hidden", true);
        $('#spiner_' + id).attr("hidden", false);
    }

    function hideSpiner(id) {
        $('#dropdown_' + id).attr("hidden", false);
        $('#spiner_' + id).attr("hidden", true);
    }
</script>

@endsection