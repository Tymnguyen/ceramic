@extends('layout.guestlayout')

@section('mainbody')

<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="section-title">
                    <h4>E-Catalogue</h4>
                </div>
                <div class="accordion" id="accordionExample">
                    @if(isset($catalogues) && $catalogues->count() > 0)
                    @foreach($catalogues as $catalogue)
                    <div class="card">
                        <div class="card-header" id="heading_{{$catalogue->id}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" style="text-decoration: none;" data-toggle="collapse" data-target="#collapse_{{$catalogue->id}}" aria-expanded="true" aria-controls="collapse_{{$catalogue->id}}">
                                    {{$catalogue->name}}
                                </button>
                            </h2>
                        </div>

                        <div id="collapse_{{$catalogue->id}}" class="collapse" aria-labelledby="heading_{{$catalogue->id}}" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="container">
                                    <ul class="list-group">
                                        @foreach($catalogue->catalogueFiles as $file)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{$file->originalfilename}}
                                            <a href="{{url('ecatalogue/downloadfile').'/'.$file->id}}"><span class="badge badge-primary badge-pill">Download</span></a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
                        <span>-- There is no post --</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection