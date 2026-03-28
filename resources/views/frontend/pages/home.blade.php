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

            <!-- Part -->
            <div class="col-xl-8 col-md-12 col-sm-12">
               <div class="smol_text">
                  {!! $homeCms->description !!}

               </div>
            </div>

            <!-- Part -->
            <div class="col-md-8">
               <div class="newnav">
                  <ul>
                     <li class="wow rollIn">
                        <img src="{{asset('public/assets/images/path1.png')}}">
                        <a href="#">Welcome</a>
                     </li>
                     <li class="wow bounceInUp">
                        <img src="{{asset('public/assets/images/path2.png')}}">
                        <a href="#">Our Core Values</a>
                     </li>
                     <li class="wow bounceInUp">
                        <img src="{{asset('public/assets/images/path3.png')}}">
                        <a href="#">Admissions</a>
                     </li>
                     <li class="wow rollIn">
                        <img src="{{asset('public/assets/images/path4.png')}}">
                        <a href="#">Extra curricular Clubs</a>
                     </li>
                  </ul>
               </div>
            </div>


            <!-- Part -->
            <div class="col-md-8">
               <div class="copyright">
                  © {{date('Y')}} | <span>{{ config('app.name', 'C-Section') }}</span> Powered by : <a href="#">Acuity Software Services Pvt. Ltd.</a>
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