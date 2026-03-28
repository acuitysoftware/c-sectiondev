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
                    {!! $aboutUsCms->description !!}
                
               </div>
            </div>


            <div class="col-xl-4 col-md-4 col-sm-12">
                <div class="right_content">
                    <h2>About Us</h2>

                    <ul class="right_nav">
                        <li><a href="{{route('aboutUs')}}" class="{{ Request::is('about-us') ? 'active' : '' }}">About Us</a></li>
                        <li><a href="{{route('visionStatement')}}" class="{{ Request::is('vision-statement') ? 'active' : '' }}" >Vision Statement</a></li>
                        <li><a href="{{route('sustainabilityDevelopmentGoal')}}" class="{{ Request::is('sustainability-development-goal') ? 'active' : '' }}">Sustainability Development Goal</a></li>
                        <li><a href="{{route('valuesEducation')}}" class="{{ Request::is('values-education') ? 'active' : '' }}">Values Education</a></li>
                        <li><a href="{{route('ourStaff')}}" class="{{ Request::is('our-staff') ? 'active' : '' }}">Our Staff</a></li>
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