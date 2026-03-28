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
          <div class="col-xl-12 col-md-12 col-sm-12">
              <div class="left_content">
                  {!! $cms->description !!}
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