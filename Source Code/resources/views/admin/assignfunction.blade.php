@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-secondary text-white" href="{{url('admin/role')}}">
            <span class="tf-icons bx bx-arrow-back"></span> Go back
        </a>
    </div>
    <div class="card mb-4">
        <form method="POST" action="{{url('/admin/upsertrolefunction')}}" enctype="multipart/form-data">
            @csrf

            <div hidden>
                <input class="form-check-input" type="text" value="{{$role->id}}" name="roleid">
            </div>
            <div class="card-body">
            <div class="table-responsive text-nowrap">
            <h5 class="card-header">ADD/REMOVE FUNCTION FOR ROLE: <b>{{$role->name}}</b></h5>
            <hr class="my-0">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($functions as $func)
                    <tr>
                        <td>
                        <div class="form-check">
                            @if(in_array($func->id, $rolefunctions))
                                <input class="form-check-input" type="checkbox" value="{{$func->id}}" name="checkedfunctions[]" checked>
                            @else
                                <input class="form-check-input" type="checkbox" value="{{$func->id}}" name="checkedfunctions[]">
                            @endif
                        </div>
                        </td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$func->name}}</strong></td>
                        <td>{{$func->description}}</td>
                        <td>{{$func->remark}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Update</button>
            </div>
            </div>
        </form>
    </div>
</div>


@endsection