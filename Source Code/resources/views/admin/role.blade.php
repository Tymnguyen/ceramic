@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <button type="button" class="btn rounded-pill btn-dark" onclick="createRole();">Create New Role</button>
    </div>
    <div class="card">
        <h5 class="card-header">ROLE LIST</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Remark</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($roles as $role)
                    <tr id="tablerow_{{$role->id}}">
                        <td>
                            <div class="dropdown" id="dropdown_{{$role->id}}">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('admin/assignfunction/'.$role->id)}}"><i class='bx bx-add-to-queue'></i> Functions</a>
                                    <a class="dropdown-item" onclick="editRole('{{$role->id}}');"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete role?');" href="{{url('admin/deleterole')}}/{{$role->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                            <div class="spinner-border spinner-border-sm text-primary" role="status" id="spiner_{{$role->id}}" hidden>
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$role->name}}</strong></td>
                        <td>{{$role->description}}</td>
                        <td>{{$role->remark}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="rolebackDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
    <form method="POST" action="{{url('/admin/upsertrole')}}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleBackDropModalTitle">New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3" hidden>
                            <label for="nameBackdrop" class="form-label">Id</label>
                            <input type="text" id="role_id" name="id" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Name</label>
                            <input type="text" id="role_name" name="name" class="form-control" placeholder="Enter Role Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Description</label>
                            <input type="text" id="role_description" name="description" class="form-control" placeholder="Enter Role Description">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Remark</label>
                            <input type="text" id="role_remark" name="remark" class="form-control" placeholder="Enter Role Remark">
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
        $('#menu_employee').addClass('active');
        $('#dataTable').DataTable({
            "pageLength": 10,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    });

    function createRole() {
        $('#roleBackDropModalTitle').text('New Role');
        $('#submitbutton').html('Create');
        $('#role_id').val('');
        $('#role_name').val('');
        $('#role_description').val('');
        $('#role_remark').val('');
        $('#rolebackDropModal').modal('toggle');
    };

    function editRole(id) {
        showSpiner(id);
        $.ajax({
            type: "GET",
            url: "/admin/getroledata/" + id,
            success: function(response) {
                $('#roleBackDropModalTitle').text('Edit Role: ' + response.name);
                $('#submitbutton').html('Revise');
                $('#role_id').val(response.id);
                $('#role_name').val(response.name);
                $('#role_description').val(response.description);
                $('#role_remark').val(response.remark);
                $('#rolebackDropModal').modal('toggle')
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