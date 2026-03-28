@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')


<!-- logoarea -->
    @include('frontend.includes.slider')
<!-- logoarea -->



   <!-- Start Page Wrapper -->
    <div class="page-wrapper">
        <livewire:frontend.user.register />
    </div>
    <!-- End Page Wrapper -->
   
            
@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection