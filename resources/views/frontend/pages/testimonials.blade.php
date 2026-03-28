@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" @if(isset($banner) && isset($banner->banner)) style="background-image: url('{{asset('storage/app/public/'.$banner->banner)}}')" @else style="background-image: url({{asset('public/assets/images/inner_header.jpg')}});" @endif>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="pageBannerContent text-center">
                    <h2>Testimonial</h2>
                    <div class="pageBannerPath">
                        <a href="{{route('home')}}">Home</a>&nbsp;&nbsp;>&nbsp;&nbsp;<span>Testimonial</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<!-- BEGIN: TestimonialPage Section -->
<section class="testimonialPage">
    <div class="container">
        <div class="row">

            @if(count($testimonials)>0)
            @foreach($testimonials as $key=>$testimonial)
            <div class="col-lg-4 col-md-6">
                <div class="testimonialItem01">
                    <div class="ti01Header clearfix">
                        <i class="tc-quote"></i>
                    </div>
                    <div class="ti01Content">
                        {!! $testimonial->description !!}
                    </div>
                    <div class="ti01Author">
                        <img src="{{asset('storage/app/public/'.$testimonial->image) }}" alt="Sanjida Ema"/>
                        <h3>{{$testimonial->client_name}}</h3>
                        <span>{{$testimonial->designation}}</span>
                    </div>
                </div>
            </div>
            @endforeach
            @endif 
            
        </div>
    </div>
</section>
<!-- END: TestimonialPage Section -->
@endsection

@section('script')
@endsection