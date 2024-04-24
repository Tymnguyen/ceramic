@extends('layout.guestlayout')

@section('mainbody')
<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__content">
                    <div class="contact__address">
                        <h5>Contact info</h5>
                        <ul>
                            <li>
                                <h6><i class="fa fa-id-card-o" aria-hidden="true"></i> Company Name</h6>
                                <p>{{isset($companyinfo) ? $companyinfo->name : ''}}</p>
                            </li>
                            <li>
                                <h6><i class="fa fa-map-marker"></i> Address</h6>
                                <p>{{isset($companyinfo) ? $companyinfo->address : ''}}</p>
                            </li>
                            <li>
                                <h6><i class="fa fa-phone"></i> Phone</h6>
                                <p>{{isset($companyinfo) ? $companyinfo->phone : ''}}</p>
                            </li>
                            <li>
                                <h6><i class="fa fa-fax" aria-hidden="true"></i> Fax</h6>
                                <p>{{isset($companyinfo) ? $companyinfo->fax : ''}}</p>
                            </li>
                            <li>
                                <h6><i class="fa fa-headphones"></i> Email</h6>
                                <a href="mailto:{{isset($companyinfo) ? $companyinfo->email : ''}}">{{isset($companyinfo) ? $companyinfo->email : ''}}</a>
                                
                            </li>
                        </ul>
                    </div>
                    <div class="contact__form">
                        <h5>LEAVE A MESSAGE WE WILL GET BACK TO YOU</h5>
                        <form action="requestcontactme" method="POST">
                            @csrf
                            @if ($errors->any())
                            <div class="col-lg-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            <input type="text" placeholder="Name" name="name" required="required" value="{{old('name') != null ? old('name') : ''}}">
                            <input type="email" placeholder="Email"  name="email" required="required" value="{{old('email') != null ? old('email') : ''}}">
                            <textarea placeholder="Message" name="message" required="required" value="{{old('message') != null ? old('message') : ''}}"></textarea>
                            <button type="submit" class="site-btn">Contact me</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__map">
                    <iframe src="{{isset($companyinfo) ? $companyinfo->embedmapurl : ''}}" height="830" style="border:0" allowfullscreen="">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
@endsection