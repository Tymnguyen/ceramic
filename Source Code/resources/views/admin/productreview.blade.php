@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-secondary text-white" href="{{url('admin/blogarticle')}}">
            <span class="tf-icons bx bx-arrow-back"></span> Go back
        </a>
    </div>
    <div class="card">
        <h5 class="card-header">Reviews</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Comment By</th>
                        <th>Content</th>
                        <th>Created Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($reviews as $review)
                    <tr id="tablerow_{{$review->id}}">
                        <td>
                            <div class="dropdown" id="dropdown_{{$review->id}}">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if($review->status == 0)
                                        <a class="dropdown-item" href="{{url('admin/product/changereviewstatus/'.$review->id)}}"><i class="bx bx-check"></i></i> Approve</a>
                                    @else
                                    <a class="dropdown-item" href="{{url('admin/product/changereviewstatus/'.$review->id)}}"><i class="bx bx-x-circle"></i></i> Disapprove</a>
                                    @endif
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this review?');" href="{{url('admin/product/deletereview')}}/{{$review->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        <td></td>
                        <td><strong>{{$review->createby->fullname}}</strong></td>
                        <td>{{$review->commentcontent}}</td>
                        <td>{{$review->createdat}}</td>
                        <td>
                            @if($review->status == 0)
                                @if($review->lastmodifiedby == null)
                                    <span style="color: coral;">New</span>
                                @else
                                <span style="color: red;">Disapproved</span>
                                @endif
                            @else
                            <span style="color: green;"><i class="bx bx-check"></i></span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#menu_product').addClass('active');
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