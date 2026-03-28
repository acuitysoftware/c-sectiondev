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
            <div class="col-xl-4 col-md-4 col-sm-12">
                
            </div>
            <div class="col-xl-4 col-md-4 col-sm-12">
              <form id="subscription_form" >
              <div class="subscription yelowbox">
                  <div class="subscription-header">
                      <h3 class="title">One Year Subscription</h3>
                  </div>
                  <div class="price-value">
                      <div class="value">
                          <span class="currency">₹</span>
                          <span class="amount">{{$user->class->price}}</span>
                      </div>
                  </div>
                  
                     {!! $cms->description !!}
                  
                       <button type="submit" class="subscription-signup">
                          <span>Pay Now</span>
                      </button>
                </div>
                </form>
                <!-- <div class="left_content">
                  <form id="subscription_form" >
                    <h4>One Year Subscription Plan</h4>
                    <p>Price : ₹{{$user->class->price}}</p>
                     <button type="submit" class="login_btn">
                          <span>Pay Now</span>
                      </button>
                  </form>
               </div> -->
            </div>
            <div class="col-xl-4 col-md-4 col-sm-12">
                
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