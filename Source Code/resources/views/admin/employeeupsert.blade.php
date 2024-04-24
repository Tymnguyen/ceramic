@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-secondary text-white" href="{{url('admin/employee')}}">
            <span class="tf-icons bx bx-arrow-back"></span> Go back
        </a>
    </div>
    <div class="card mb-4">
        <form method="POST" action="{{url('/admin/employeeupsertpost')}}" enctype="multipart/form-data">
            @csrf
            <h5 class="card-header">{{isset($employee) ? 'Revise Employee'.$employee->firstname.' '.$employee->lastname.' Data' : 'Create New Employee'}}</h5>
            <!-- Account -->
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{isset($employee) ? asset('adminasset/img/avatars').'/'.$employee->profilepicture : asset('adminasset/img/avatars').'/noAvatar.jpg'}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">{{isset($employee) ? 'Change Profile Photo' : 'Upload Profile Photo'}}</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" name="uploadprofilepicture" class="account-file-input"  hidden="" accept="image/png, image/jpeg">
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Remove</span>
                          </button>
                        <p class="text-muted mb-0">Allowed JPG, JPEG or PNG. Max size of 2MB</p>
                    </div>
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
                            <input class="form-control" type="text" id="id" name="id" value="{{old('id') != null ? old('id') : (isset($employee) ? $employee->id : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstname" class="form-label">First Name</label>
                            <input class="form-control" type="text" id="firstname" name="firstname" value="{{old('firstname') != null ? old('firstname') : (isset($employee) ? $employee->firstname : '')}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="lastname" id="lastname" value="{{old('lastname') != null ? old('lastname') : (isset($employee) ? $employee->lastname : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{old('address') != null ? old('address') : (isset($employee) ? $employee->address : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="idnumber" class="form-label">ID Number</label>
                            <input class="form-control" type="text" id="idnumber" name="idnumber" value="{{old('idnumber') != null ? old('idnumber') : (isset($employee) ? $employee->idnumber : '')}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="phonenumber" class="form-label">Phone Number</label>
                            <input class="form-control" type="text" name="phonenumber" id="phonenumber" value="{{old('phonenumber') != null ? old('phonenumber') : (isset($employee) ? $employee->phonenumber : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{old('email') != null ? old('email') : (isset($employee) ? $employee->email : '')}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="text" name="password" id="password" value="{{old('password') != null ? old('password') : ''}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input class="form-control" type="date" id="dob" name="dob" value="{{old('dob') != null ? old('dob') : (isset($employee) ? $employee->dob : '')}}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="joindate" class="form-label">Join Date</label>
                            <input class="form-control" type="date" id="joindate" name="joindate" value="{{old('joindate') != null ? old('joindate') : (isset($employee) ? $employee->joindate : '')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="roleid " class="form-label">Role</label>
                            <select id="roleid" name="roleid" class="select2 form-select">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    @if(old('roleid') != null)
                                        @if(old('roleid') == $role->id)
                                        <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                        @else
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endif
                                    @elseif(isset($employee))
                                        @if($employee->roleid == $role->id)
                                        <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                        @else
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endif
                                    @else
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">{{isset($employee) ? 'Save Changes' : 'Create'}}</button>
                    </div>
                </div>
            </div>
            <!-- /Account -->
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#menu_employee').addClass('active');
    });
</script>

@endsection