@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <button type="button" class="btn rounded-pill btn-dark" onclick="createNew();">Create New Delivery Fee</button>
    </div>
    <div class="card">
        <h5 class="card-header">DELIVERY FEE</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Delivery Area</th>
                        <th>Cost</th>
                        <th>Remark</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($deliveryfees as $deliveryfee)
                    <tr id="tablerow_{{$deliveryfee->id}}">
                        <td>
                            <div class="dropdown" id="dropdown_{{$deliveryfee->id}}">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="editDeliveryFee('{{$deliveryfee->id}}');"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this delivery fee?');" href="{{url('admin/deletedeliveryfee')}}/{{$deliveryfee->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                            <div class="spinner-border spinner-border-sm text-primary" role="status" id="spiner_{{$deliveryfee->id}}" hidden>
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$deliveryfee->name}}</strong></td>
                        <td>{{$deliveryfee->cost}}</td>
                        <td>{{$deliveryfee->remark}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
    <form method="POST" action="{{url('/admin/upsertdeliveryfee')}}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3" hidden>
                            <label for="fee_id" class="form-label">Id</label>
                            <input type="text" id="fee_id" name="id" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="fee_name" class="form-label">Name</label>
                            <input type="text" id="fee_name" name="name" class="form-control" placeholder="Enter Delivery Area">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="fee_cost" class="form-label">Cost</label>
                            <input type="text" id="fee_cost" name="cost" class="form-control" placeholder="Enter Cost">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="fee_remark" class="form-label">Remark</label>
                            <input type="text" id="fee_remark" name="remark" class="form-control" placeholder="Enter Remark">
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
        $('#menu_feeandvoucher').addClass('active');
        $('#dataTable').DataTable({
            "pageLength": 10,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    });

    function createNew() {
        $('#backDropModalTitle').text('New Delivery Fee');
        $('#submitbutton').html('Create');
        $('#fee_id').val('');
        $('#fee_name').val('');
        $('#fee_cost').val('');
        $('#fee_remark').val('');
        $('#backDropModal').modal('toggle');
    };

    function editDeliveryFee(id) {
        showSpiner(id);
        $.ajax({
            type: "GET",
            url: "/admin/editdeliveryfee/" + id,
            success: function(response) {
                $('#backDropModalTitle').text('Edit Fee: ' + response.name);
                $('#submitbutton').html('Revise');
                $('#fee_id').val(response.id);
                $('#fee_name').val(response.name);
                $('#fee_cost').val(response.cost);
                $('#fee_remark').val(response.remark);
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