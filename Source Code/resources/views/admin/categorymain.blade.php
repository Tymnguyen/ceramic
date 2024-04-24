@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <button type="button" class="btn rounded-pill btn-dark" onclick="create();">Create New Main Category</button>
    </div>
    <div class="card">
        <h5 class="card-header">MAIN CATEGORY</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Category name</th>
                        <th>Remark</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($categories as $category)
                    <tr id="tablerow_{{$category->id}}">
                        <td>
                            <div class="dropdown" id="dropdown_{{$category->id}}">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('admin/category/categorysub')}}/{{$category->id}}"><i class="bx bx-align-left me-1"></i> Subcategory</a>
                                    <a class="dropdown-item" onclick="edit('{{$category->id}}');"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this category?');" href="{{url('admin/category/deletemaincategory')}}/{{$category->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                            <div class="spinner-border spinner-border-sm text-primary" role="status" id="spiner_{{$category->id}}" hidden>
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$category->name}}</strong></td>
                        <td>{{$category->remark}}</td>
                        <td>{{$category->createdat}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
    <form method="POST" action="{{url('/admin/category/createmaincategory')}}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">New Main Category</h5>
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
                            <label for="_name" class="form-label">Main Category Name</label>
                            <input type="text" id="_name" name="name" class="form-control" placeholder="Enter Category Name" required>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col mb-3">
                            <label for="picture" class="form-label">Picture</label>
                            <input class="form-control" type="file" id="picture" name="picture" accept="image/png, image/jpeg">
                        </div>
                    </div> -->
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
        $('#backDropModalTitle').text('New Main Category');
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
            url: "/admin/category/getmaincategory/" + id,
            success: function(response) {
                $('#backDropModalTitle').text('Edit Main Category: ' + response.name);
                $('#submitbutton').html('Revise');
                $('#_id').val(response.id);
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