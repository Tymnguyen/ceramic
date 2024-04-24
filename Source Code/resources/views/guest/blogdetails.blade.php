@extends('layout.guestlayout')

@section('mainbody')

<!-- Blog Details Section Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                    <a href="{{url('/blog')}}">Blog</a>
                    <span>{{$blog->name}}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="blog__details__content">
                    <div class="blog__details__item">
                        <img src="img/blog/details/blog-details.jpg" alt="">
                        <div class="blog__details__item__title">
                            <h4>{{$blog->name}}</h4>
                            <ul>
                                <li>by <span>{{$blog->author->firstname}} {{$blog->author->lastname}}</span></li>
                                <li>{{$blog->createdat}}</li>
                                <li>{{$blog->description}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog__details__desc">
                        {!!$blog->content!!}
                    </div>

                    <div class="blog__details__btns">
                        <div class="row d-flex justify-content-center">
                            <h6>-- END --</h6>
                        </div>
                    </div>

                    <div class="contact__form">
                        @if(session()->has('userid'))
                        <form action="{{url('/blog/leavecomment')}}" method="POST">
                            @csrf
                            <input type="text" name="id" value="{{$blog->id}}" hidden>
                            <textarea placeholder="Leave comment..." style="height:100px;" name="commenttext"></textarea>
                            <button type="submit" class="site-btn">Comment</button>
                        </form>
                        @else
                        <form action="#" disabled>
                            <textarea placeholder="Please login to leave comment..." style="height:100px;" disabled></textarea>
                        </form>
                        @endif
                    </div>

                    <div class="blog__details__comment" style="margin-top: 15px; max-height:500px; overflow:scroll;">

                        @if(isset($comments))
                        <h5>{{$comments->count()}} Comments</h5>
                        @foreach($comments as $comment)
                        <div class="blog__comment__item">
                            <div class="blog__comment__item__pic">
                                <img src="{{$comment->createby->avatar}}" alt="" style="width:80px;">
                            </div>
                            <div class="blog__comment__item__text">
                                @if(session()->has('userid') && session('userid') == $comment->createdby)
                                <h6>{{$comment->createby->fullname}} <a onclick="return confirm('Do you want to delete this comment?');" href="{{url('/blog/deletemycomment')}}/{{$comment->id}}" style="color: red;">(Remove)</a></h6>
                                @else
                                <h6>{{$comment->createby->fullname}}</h6>
                                @endif
                                <p>{{$comment->commentcontent}}</p>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> {{$comment->createdat}}</li>
                                </ul>
                            </div>
                        </div>

                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

@endsection