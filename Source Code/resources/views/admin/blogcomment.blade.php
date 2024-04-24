@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a type="button" class="btn rounded-pill btn-secondary text-white" href="{{url('admin/blogarticle')}}">
            <span class="tf-icons bx bx-arrow-back"></span> Go back
        </a>
    </div>
    <div class="card">
        <h5 class="card-header">COMMENT ON ARTICLE: <b>{{$article->name}}</b></h5>
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
                    @foreach ($comments as $comment)
                    <tr id="tablerow_{{$article->id}}">
                        <td>
                            <div class="dropdown" id="dropdown_{{$article->id}}">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if($comment->status == 0)
                                        <a class="dropdown-item" href="{{url('admin/changecommentstatus/'.$comment->id)}}"><i class="bx bx-check"></i></i> Approve</a>
                                    @else
                                    <a class="dropdown-item" href="{{url('admin/changecommentstatus/'.$comment->id)}}"><i class="bx bx-x-circle"></i></i> Disapprove</a>
                                    @endif
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this article?');" href="{{url('admin/deletecomment')}}/{{$comment->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        <td></td>
                        <td><strong>{{$comment->createby->fullname}}</strong></td>
                        <td>{{$comment->commentcontent}}</td>
                        <td>{{$comment->createdat}}</td>
                        <td>
                            @if($comment->status == 0)
                                @if($comment->lastmodifiedby == null)
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
        $('#menu_blog').addClass('active');
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