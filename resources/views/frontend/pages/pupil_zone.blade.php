@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')


<!-- logoarea -->
    @include('frontend.includes.slider')
<!-- logoarea -->

 <!-- Start Page Wrapper -->
 <div class="page-wrapper">


    <div class="container">
       <div class="row">
          <div class="col-xl-8 col-md-4 col-sm-12">
              <div class="left_content">
                  {!! $pupilZoneCms->description !!}
             </div>
          </div>


          <div class="col-xl-4 col-md-4 col-sm-12">
                <div class="right_content">
                    <h2>Pupil Zone</h2>

                    <ul class="right_nav">
                        <li><a  href="{{route('timeToThink')}}" class="{{ Request::is('time-to-think') ? 'active' : '' }}">Time to Think</a></li>
                        <li><a  href="{{route('resourcesAndFeatures')}}" class="{{ Request::is('resources-and-features') ? 'active' : '' }}">Resources and Features</a></li>
                        <li><a  href="{{route('whyChooseUs')}}" class="{{ Request::is('why-choose-us') ? 'active' : '' }}">Why choose us</a></li>
                        <li><a  href="{{route('conclusion')}}" class="{{ Request::is('conclusion') ? 'active' : '' }}">Conclusion</a></li>
                        <li><a  href="{{route('howItWorks')}}" class="{{ Request::is('how-it-works') ? 'active' : '' }}">How it works ?</a></li>
                        <!-- <li><a href="#">Blogs</a></li> -->
                    </ul>
                </div>
            </div>


       </div>
    </div>
 </div>
 <!-- End Page Wrapper -->
   
            
@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection