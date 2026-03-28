@extends('frontend.layouts.user-app')
@section('css')
@endsection

@section('content')


<!-- logoarea -->
    @include('frontend.includes.top_section')
<!-- logoarea -->

<!-- Start Page Wrapper -->
<div class="page-wrapper">

  <livewire:frontend.user.withdraw />

</div>
<!-- End Page Wrapper -->



            
@endsection

@section('script')

   </script>
@endsection