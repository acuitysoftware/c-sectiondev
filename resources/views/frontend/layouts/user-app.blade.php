<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.png')}}" />
      @yield('head_tag')
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" />
      <link href="{{asset('public/admin_assets/vendors/general/toastr/build/toastr.min.css')}}" rel="stylesheet" type="text/css" />
      <!-- Bootstrap CSS -->
      
     

      
    <!-- Stylesheets -->
     <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet">

     <link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet">
     <link href="{{asset('public/assets/css/responsive.css')}}" rel="stylesheet">
        
    <link rel="stylesheet" href="{{asset('public/assets/css/fontawesome-all.css')}}">

      <title>@if(isset($seo->title)){{$seo->title}} @else {{$title}}@endif</title>
      <meta name="description" content="@if(isset($seo->description)){{$seo->description}}@endif" />
      <meta name="keywords" content="@if(isset($seo->keywords)){{$seo->keywords}}@endif" />
      
   </head>
    <style type="text/css">
        .error{
          color: red !important;
          font-size: 12px;
        }
        .is-invalid{
              color: red;
              font-size: 12px;
              position: absolute;
              /* top: 0; */
              bottom: -23px;
              right: 0;
              font-weight: 200;
        }
        .toast-error {
          background-color: #bd362f;
        }
        .toast-success {
          background-color: #51a351;
        }
        .toast-warning {
          background-color: #ffc107;
        }
      </style>
<body class="insidebg">
    <!-- preloader -->
     <div class="preloader"></div>
    <!-- preloader -->
    
     <!--toparea-->
      @livewireStyles
      @yield('css')
      @include('frontend.includes.header')
      @yield('content')
      @include('frontend.includes.footer')
      @livewireScripts

      <!--Scroll to top-->
   <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

        

  <!-- End Color Switcher -->
   <script src="{{asset('public/assets/js/jquery.js')}}"></script>
   <script src="{{asset('public/assets/js/popper.min.js')}}"></script>

   <!--Revolution Slider-->
   <script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
   <script src="{{asset('public/assets/js/jquery.isotope.min.js')}}"></script>
   <script src="{{asset('public/assets/js/jquery.fancybox.js')}}"></script>
   <script src="{{asset('public/assets/js/appear.js')}}"></script>
   <script src="{{asset('public/assets/js/wow.js')}}"></script>
   <script src="{{asset('public/assets/js/script.js')}}"></script>




        <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/trumbowyg.min.js'></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
      <script src="{{asset('public/admin_assets/vendors/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('public/admin_assets/app/custom/general/components/extended/toastr.js')}}" type="text/javascript"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
      <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
      
      <!--slider-->
   <script type="text/javascript" src="{{asset('public/assets/js/jquery.backstretch.js')}}"></script>
   <script>
    var images = new Array();
    
    @foreach($sliderImages as $key => $val)
      images.push('{{$val}}');
    @endforeach

      $.backstretch(images, {
         fade: 750,
         duration: 4000
      });
   </script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
   <script type="text/javascript">


        $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('submit','#login_form', function(e) {
            e.preventDefault();
            var data = $(this).serializeArray();
            $('div.is-invalid').html('');
            $.ajax({
                url: "{{route('user.login.submit')}}",
                method: "post",
                data: data,
                dataType: "json",
                success: function (result) {
                    if(result.code == 0){
                        $.each(result.error, function( key, value ) {
                            $('div.'+key).html(value);
                        });
                    }
                    else if(result.code == 2){
                        order_id = result.order_id;
                        email = result.email;
                        id = result.id;
                        name = result.name;
                        phone = result.phone;
                        total_amount = result.total_amount*100;
                        
                      var options = {
                      "key": "{{$siteSetting->razor_pay_key}}",
                      "order_id": order_id,
                      "amount": total_amount,
                      "currency": "INR",
                      "name": name,
                      "description": "C-section Class Payment",
                      "image": "{{asset('storage/app/public/'.@$siteSetting->logo) }}",
                      "handler": function(response) {
                        console.log('response');
                        console.log(response);
                        if(response.razorpay_order_id != "")
                        {
                          
                          $('#razorpay_payment_id').val(response.razorpay_payment_id);
                          $('#razorpay_order_id').val(response.razorpay_order_id);
                         
                          $.ajax({
                          type: "POST",
                             url: "{{route('payment')}}",
                            method: "post",
                            data: {
                              'id': id,
                              'razorpay_payment_id': response.razorpay_payment_id,
                              'razorpay_order_id': response.razorpay_order_id,
                          },
                            dataType: "json",
                            success: function(jsn) {
                              if(jsn.status == true)
                              {
                                //toastr["success"]('Your order placed successfully');
                                window.location = "{{route('user.profile')}}";
                              }
                              else{
                                 toastr["error"]('Something went wrong');
                              }
                            }
                          });
                          
                        }
                    },
                    "prefill": {
                        "name": name,
                        "email": email,
                        "contact": phone
                    },
                    "notes": {
                        "address": 'Kolkata'
                    },
                    "theme": {
                        "color": "#528FF0"
                    }
                };
                var rzp1 = new Razorpay(options);
                        rzp1.open();
                        e.preventDefault();
                    }
                    else if(result.code == 1){
                        window.location.href = "{{route('home')}}";
                    }
                }
            });
        });

       /* $(document).on('submit','#profile_form', function(e) {
            e.preventDefault();
            var data = $(this).serializeArray();
            console.log(data);
            $('div.is-invalid').html('');
            $.ajax({
                url: "{{route('user.profile.save')}}",
                method: "post",
                data: data,
                mimeType: "multipart/form-data",
                    dataType:'json',
                success: function (result) {
                    if(result.code == 0){
                        $.each(result.error, function( key, value ) {
                            $('div.'+key).html(value);
                        });
                    }
                    else if(result.code == 1){
                       window.location.href = "{{route('user.account')}}";
                    }
                }
            });
        });*/
        $(document).on('submit','#forgot_password_form', function(e) {
            e.preventDefault();
            var data = $(this).serializeArray();
            $('div.is-invalid').html('');
            $.ajax({
                url: "{{route('user.forgot.password')}}",
                method: "post",
                data: data,
                dataType: "json",
                success: function (result) {
                    if(result.code == 0){
                        $.each(result.error, function( key, value ) {
                            $('div.'+key).html(value);
                        });
                    }
                    else if(result.code == 1){
                       window.location.href = "{{route('user.login')}}";
                    }
                }
            });
        });

    });
      </script>
   <!--//slider-->
      @include('frontend.includes.script')
      @yield('script')
   </body>
</html>