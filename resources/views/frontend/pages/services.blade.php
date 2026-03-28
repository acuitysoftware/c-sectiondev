@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')

<!-- CONTENT START -->
        <div class="page-content">
        
            <!-- INNER PAGE BANNER -->
            <div class="wt-bnr-inr overlay-wraper bg-center" @if(isset($banner) && isset($banner->banner)) style="background-image: url('{{asset('storage/app/public/'.$banner->banner)}}')" @else style="background-image: url({{asset('public/assets/images/banner.jpg')}});" @endif>
                <div class="overlay-main site-bg-primary opacity-09"></div>
                <div class="container">
                    <div class="wt-bnr-inr-entry">
                        <div class="banner-title-outer">
                            <div class="banner-title-name">
                                <h2 class="site-text-white">Services</h2>
                            </div>
                        </div>
                        <!-- BREADCRUMB ROW -->                            
                        
                            <div>
                                <ul class="wt-breadcrumb breadcrumb-style-2">
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li>Services</li>
                                </ul>
                            </div>
                        
                        <!-- BREADCRUMB ROW END -->                        
                    </div>
                </div>
            </div>
            <!-- INNER PAGE BANNER END -->

            <!-- ALL SERVICES START -->
            <div class="section-full p-t120 p-b90">
                <div class="container">

                    
                    <!-- TITLE START-->
                        <div class="section-head center wt-small-separator-outer">
                            <div class="wt-small-separator site-text-green">
                                <div class="sep-leaf-left"><i class="flaticon-wiping-swipe-for-floors"></i></div>
                                <div>Our Services</div>
                            </div>
                            <h2>Expert cleaning service you can trust</h2>
                            
                        </div>
                    <!-- TITLE END-->
                     
                        <div class="section-content"> 
                            <div class="row  d-flex">
                                @if(count($services)>0)
                                @foreach($services as $key=>$service)
                                <div class="col-lg-4 col-md-6 m-b30">
                                    <div class="wt-box d-icon-box-one bg-white shadow card1 radius-md">
                                    
                                        <div class="wt-icon-box-wraper m-b20">
                                            <div class="icon-xl inline-icon">
                                                <span class="icon-cell site-text-green"><i class="flaticon-wiper"></i></span>
                                            </div>
                                        </div> 
                                        

                                         <div class="d-icon-box-one-media m-b20">
                                                <img src="{{asset('storage/app/public/'.$service->image)}}" alt="">
                                         </div>                                               
                                        <div class="d-icon-box-title title-style-2 site-text-secondry">
                                            <h3  class="s-title-one">
                                            @if(strlen(strip_tags($service->title)) > 35)
                                                {!! substr(strip_tags($service->title),0,35)."..." !!}
                                            @else
                                                {!! strip_tags($service->title) !!}
                                            @endif
                                        </h3>
                                        </div>
                                        
                                        <div class="d-icon-box-content">
                                            <p>@if(strlen(strip_tags($service->description)) > 70)
                                                {!! substr(strip_tags($service->description),0,70)."..." !!}
                                            @else
                                                {!! strip_tags($service->description) !!}
                                            @endif</p>
                                            <a href="{{route('serviceDetails', $service->slug)}}" class="site-button-link site-text-green">Read More</a>
                                        </div>
                                    </div>
                                </div> 
                                @endforeach
                                @endif
                                
                                
                            </div>                            
                        </div>
                </div>
            </div>   
            <!-- ALL SERVICES SECTION END -->  
 
      
        </div>
        <!-- CONTENT END -->

@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection