@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a href="{{url('admin/ecataloguefileupsert')}}" class="btn rounded-pill btn-dark" style="color: white;">Upload New File</a>
    </div>
    <div class="card">
        <h5 class="card-header">E-CATALOGUE FILE</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Original File Name</th>
                        <th>Ecatalogue Category</th>
                        <th>Server File Name</th>
                        <th>Remark</th>
                        <th>Download Count</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($files as $file)
                    <tr id="tablerow_{{$file->id}}">
                        <td>
                            <div class="dropdown" id="dropdown_{{$file->id}}">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('admin/ecataloguefileupsert')}}/{{$file->id}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this file?');" href="{{url('admin/deleteecataloguefile')}}/{{$file->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$file->name}}</strong></td>
                        <td>{{$file->originalfilename}}</td>
                        <td>{{$file->ecatalogueCategory->name}}</td>
                        <td>{{$file->serverfilename}}</td>
                        <td>{{$file->remark}}</td>
                        <td>{{$file->downloaded}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#menu_ecatalogue').addClass('active');
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