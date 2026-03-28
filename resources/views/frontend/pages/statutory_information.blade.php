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
                  {!! $statutoryInformationCms->description !!}
             </div>
          </div>


          <div class="col-xl-4 col-md-4 col-sm-12">
              <div class="right_content">
                  <h2>Statutory Information</h2>
                  <ul class="right_nav">
                      <li><a href="{{route('commitment')}}" class="{{ Request::is('commitment') ? 'active' : '' }}">Commitment</a></li>
                      <li><a href="{{route('policies')}}" class="{{ Request::is('policies') ? 'active' : '' }}">Policies</a></li> 
                      <li><a href="{{route('unrivalledSupport')}}" class="{{ Request::is('unrivalled-support') ? 'active' : '' }}">Unrivalled Support</a></li>
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