@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <a href="{{url('admin/upsertblogarticle')}}" class="btn rounded-pill btn-dark">CREATE NEW ARTICLE</a>
    </div>
    <div class="card">
        <h5 class="card-header">BLOG ARTICLE</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>View Count</th>
                        <th>Created Date</th>
                        <th>Created By</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($articles as $article)
                    <tr id="tablerow_{{$article->id}}">
                        <td>
                            <div class="dropdown" id="dropdown_{{$article->id}}">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('admin/upsertblogarticle/'.$article->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="{{url('admin/blogcomment/'.$article->id)}}"><i class="bx bx-conversation me-1"></i> Manage Comments</a>
                                    <a class="dropdown-item" onclick="return confirm('Do you want to delete this article?');" href="{{url('admin/deleteblogarticle')}}/{{$article->id}}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                        <td></td>
                        <td><strong>{{$article->name}}</strong></td>
                        <td>{{$article->description}}</td>
                        <td>{{$article->category->name}}</td>
                        <td>{{$article->viewcount}}</td>
                        <td>{{$article->createdat}}</td>
                        <td>{{$article->author->firstname}} {{$article->author->lastname}}</td>
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