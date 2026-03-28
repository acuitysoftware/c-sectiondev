@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<!-- Gallery -->
<section class="restaurant-mn">
    <div class="container">
        <article class="row" >
            <div class="col-md-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <h2 class="color-red">
                <span class="side-img left-side-img color-red"><i></i><i></i><i></i></span>
                Our Gallery
                <span class="side-img right-side-img color-red"><i></i><i></i><i></i></span>
                </h2>
                <p class="paragraph-heading">&nbsp;</p>
                </div>
            </div>
        </article>
        
        <div class="row">
            @if(count($galleries)>0)
            @foreach($galleries as $key2=>$gallery)
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-item-gallery">
                    <a href="{{asset('storage/app/public/'.$gallery->image)}}" data-lightbox="thegallery" title="">
                        <span class="plus"><i class="mdi mdi-plus"></i></span>
                        <img src="{{asset('storage/app/public/'.$gallery->image)}}" class="img-responsive" title="Image 1" alt="">
                    </a>
                </div>
            </div>
            @endforeach
            @endif 
        </div>
    </div>
</section>
<!-- Gallery End -->    

@include('frontend.includes.app_section')
@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection