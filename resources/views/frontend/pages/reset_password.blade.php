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
		    <div class="row justify-content-center">
		        <div class="col-xl-8 col-md-8 col-sm-12">
		            <div class="logincontent">



		                <div class="loginright">
		                    <h2>Reset Password</h2>

		                    <div class="welcomebox">
		                       <!--  <h3>Welcome!</h3>
		                        <p>Enter your details and start journey with us</p> -->
		                    </div>

		                    <div class="login_icon">
		                        <img src="{{asset('public/assets/images/loginicon.svg')}}" alt="">
		                    </div>


		                </div>

		                <div class="loginleft">
		                    <form action="{{route('reset_password_save')}}" method="post">
		                    	@csrf
		                       
		                        <input type="hidden" name="email" value="{{$user->email}}">
		                        <div class="form-group">
		                            <label>Password</label>
		                            <input type="password" class="form-control" name="password" required="">
		                            @error('password') <div class="error">{{ $message }}</div> @enderror
		                        </div>
		                        <div class="form-group">
		                            <label>Confirm Password</label>
		                            <input type="password" class="form-control" name="password_confirmation" required="">
		                            @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
		                        </div>
		                      

		                       
		                        <button type="submit" class="login_btn">
		                            <span>Reset Password</span>
		                        </button>

		                    </form>
		                </div>

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