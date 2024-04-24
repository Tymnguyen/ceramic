@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <button type="button" class="btn rounded-pill btn-dark" onclick="createCategory();">Create New Category</button>
    </div>
    <div class="card">
        <h5 class="card-header">BLOG CATEGORY</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Remark</th>
                        <th>Created Date</th>

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
                                    <a class="dropdown-item" onclick="editcategory('{{$category->id}}');"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this category?');" href="{{url('admin/deleteblogcategory')}}/{{$category->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                            <div class="spinner-border spinner-border-sm text-primary" role="status" id="spiner_{{$category->id}}" hidden>
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                        <td><strong>{{$category->name}}</strong></td>
                        <td>{{$category->remark}}</td>
                        <td>{{$category->createdat}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="categorybackDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
    <form action="{{url('/admin/upsertblogcategory')}}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryBackDropModalTitle">NEW CATEGORY</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3" hidden>
                            <label for="nameBackdrop" class="form-label">Id</label>
                            <input type="text" id="category_id" name="id" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Name</label>
                            <input type="text" id="category_name" name="name" class="form-control" placeholder="Enter Category Name" require="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Remark</label>
                            <input type="text" id="category_remark" name="remark" class="form-control" placeholder="Enter Category Remark">
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
        $('#menu_blog').addClass('active');
        $('#dataTable').DataTable({
            "pageLength": 10,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    });

    function createCategory() {
        $('#categoryBackDropModalTitle').text('NEW CATEGORY');
        $('#submitbutton').html('Create');
        $('#category_id').val('');
        $('#category_name').val('');
        $('#category_remark').val('');
        $('#categorybackDropModal').modal('toggle');
    };

    function editcategory(id) {
        showSpiner(id);
        $.ajax({
            type: "GET",
            url: "/admin/getblogcategory/" + id,
            success: function(response) {
                $('#categoryBackDropModalTitle').text('EDIT CATEGORY: ' + response.name);
                $('#submitbutton').html('Revise');
                $('#category_id').val(response.id);
                $('#category_name').val(response.name);
                $('#category_remark').val(response.remark);
                $('#categorybackDropModal').modal('toggle')
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