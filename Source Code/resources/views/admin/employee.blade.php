@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a href="{{url('admin/employeeupsert/')}}" class="btn rounded-pill btn-dark">Create New Employee</a>
    </div>
    <div class="card">
        <h5 class="card-header">EMPLOYEE LIST</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr class="text-nowrap">
                        <th></th>
                        <th></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Role</th>
                        <th>Join Date</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($employees as $employee)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('admin/employeeupsert/'.$employee->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete role?');" href="{{url('admin/deleterole')}}/{{$employee->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($employee->profilepicture == null || $employee->profilepicture == '')
                            <div class="avatar">
                                <img src="{{asset('adminasset')}}/img/avatars/noAvatar.jpg" alt="" class="w-px-40 h-auto rounded-circle">
                            </div>
                            @else
                            <div class="avatar">
                                <img src="{{asset('adminasset')}}/img/avatars/{{$employee->profilepicture}}" alt="" class="w-px-40 h-auto rounded-circle">
                            </div>
                            @endif
                        </td>
                        <td>{{$employee->firstname}}</td>
                        <td>{{$employee->lastname}}</td>
                        <td>{{$employee->phonenumber}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->dob}}</td>
                        <td>{{$employee->role->name}}</td>
                        <td>{{$employee->joindate}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
</script>

@endsection