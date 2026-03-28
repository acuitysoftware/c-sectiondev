@extends('frontend.layouts.user-app')
@section('css')
@endsection

@section('content')


<!-- logoarea -->
    @include('frontend.includes.top_section')
<!-- logoarea -->



 <!-- Start Page Wrapper -->
   <div class="page-wrapper">
   		<div class="container">
	   		<div class="row">
		   		<div class="col-xl-12 col-md-12 col-sm-12">
		   			<p ><span style="color: #cd08e5;">Board Name :</span> <span style="color: #08e59e;">{{Auth::user()->board->name}}</span>, 
              <span style="color: #cd08e5;">Class Name :</span><span style="color: #08e59e;"> {{Auth::user()->class->name}}</span></p>
		   		</div>
	   		</div>
   		</div>
      <livewire:frontend.user.profile />

   </div>
   <!-- End Page Wrapper -->

            
@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection