@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">REQUEST TO CONTACT</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr class="text-nowrap">
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Sent date</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($requests as $request)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('admin/contactrequest_markdone/'.$request->id)}}"><i class="bx bx-check"></i> Mark done</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this request?');" href="{{url('admin/contactrequest_delete')}}/{{$request->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        <td>{{$request->name}}</td>
                        <td>{{$request->email}}</td>
                        <td>{{$request->message}}</td>
                        <td>{!!$request->contactback == 1 ? '<span style="color: green;"><i class="bx bx-check"></i></span>' : '<span style="color: coral;">New!</span>'!!}</td>
                        <td>{{$request->createdat}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#menu_support').addClass('active');
        $('#dataTable').DataTable({
            "pageLength": 10,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    });
</script>

@endsection