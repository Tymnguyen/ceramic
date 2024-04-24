@extends('layout.guestlayout')

@section('mainbody')

<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>BLOG CATAGORY</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <form action="{{url('blog/findblog')}}" method="POST">
                                        @csrf
                                        <style>
                                            .form-control:focus {
                                                outline: none;
                                                /* Remove outline */
                                                box-shadow: none;
                                                /* Remove box shadow */
                                            }
                                        </style>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="searchblog" style="font-size: small;" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary" type="submit">Find article</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card">
                                    <div>
                                        <a href="{{url('blog')}}">All</a>
                                    </div>
                                </div>
                                @if(isset($blogcatagories))
                                @foreach($blogcatagories as $category)
                                <div class="card">
                                    <div>
                                        <a href="{{url('blog')}}/{{$category->id}}">{{$category->name}}</a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-9">
                <!-- Blog Section Begin -->
                <div class="container ">
                    <div class="row overflow-auto" style="max-height: 500px;">

                        @if(isset($articles))
                        @if($articles->count() > 0)
                        @foreach($articles as $article)
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="{{url('blog/blogdetails')}}/{{$article->id}}">
                                <div class="blog__item">
                                    <div class="blog__item__pic set-bg" data-setbg="{{asset('guestasset/img/blog')}}/{{$article->coverimage}}"></div>
                                    <div class="blog__item__text">
                                        <h6>{{$article->name}}</h6>
                                        <ul>
                                            <li>by <span>{{$article->author->firstname}} {{$article->author->lastname}}</span></li>
                                            <li>{{$article->createdat}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        @else
                        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
                            <span>-- There is no post --</span>
                        </div>
                        @endif

                        @endif

                        <!-- <div class="col-lg-12 text-center">
                                <a href="#" class="primary-btn load-btn">Load more posts</a>
                            </div> -->
                    </div>
                </div>
                <!-- Blog Section End -->

            </div>
        </div>
    </div>
</section>
@endsection