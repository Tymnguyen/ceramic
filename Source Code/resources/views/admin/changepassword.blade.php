@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">CHANGE PASSWORD</h5>
        <hr class="my-0"></br>
        <div class="card-body" style="display:flex; justify-content:center;">
            <form action="{{url('/admin/changepasswordpost')}}" method="POST" style="width: 60%; ">
                @csrf
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

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="currentpassword" class="form-label">Current Password</label>
                            <input class="form-control" type="password" name="currentpassword" id="currentpassword" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="newpassword" class="form-label">New Password</label>
                            <input class="form-control" type="password" name="newpassword" id="newpassword" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="confirmnewpassword" class="form-label">Confirm New Password</label>
                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="">
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Change</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>



@endsection