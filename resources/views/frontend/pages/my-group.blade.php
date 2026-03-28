@extends('frontend.layouts.user-app')
@section('css')
@endsection

@section('content')


<!-- logoarea -->
    @include('frontend.includes.top_section')
<!-- logoarea -->



<!-- Start Page Wrapper -->
   <div class="page-wrapper">

      <!-- --------------- -->
      <div class="container">
         <div class="row">
            <div class="col-xl-3 col-md-3 col-sm-12">
               @include('frontend.includes.subject_list')
            </div>

            <div class="col-xl-6 col-md-6 col-sm-12">
               <div class="mid_content">
                  <h1 class="pagetitle">My Group</h1>

                  <!-- content_box -->
                  <div class="content_box">  
                  <div class="row">  
                  	@if(count($group_users)>0)
            		@foreach($group_users as $key2=>$userData)
                     <div class="col-xl-4 col-md-4 col-sm-12">
                        <div class="group_content">
                           <div class="group_images">
                             @if(isset($userData->profile_photo_path))
				            <img src="{{asset('storage/app/public/'.$userData->profile_photo_path) }}" alt="user">
				            @else
				            <img src="{{asset('public/assets/images/no_image.png')}}" alt="user">
				            @endif
                           </div>
                           <div class="group_name">{{$userData->name}}</div>
                           <div class="group_class">{{$userData->class->name}}</div>
                        </div>
                     </div>
                     @endforeach
                     @else
                     	<div class="col-xl-12 col-md-12 col-sm-12">
                     		<p style="text-align: center;">No records found</p>
                     	</div>
            		@endif 
                 
                  </div>
                  </div>
                  <!-- content_box -->
               </div>

               <div class="weeklybox">
                  <a href="#" class="weekly1_btn">Weekly Test</a>
                  <a href="#" class="weekly2_btn">Group Weekly Test</a>
               </div>
            </div>


            @include('frontend.includes.profile_side_bar')
         </div>
      </div>
      <!-- --------------- -->



      @include('frontend.includes.exam_side_bar')

   </div>
   <!-- End Page Wrapper -->

            
@endsection

@section('script')
   <script type="text/javascript">


   </script>
@endsection