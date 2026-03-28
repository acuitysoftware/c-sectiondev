@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')


<!-- logoarea -->
    @include('frontend.includes.slider')
<!-- logoarea -->



   <!-- Start Page Wrapper -->
    <div class="page-wrapper">
       {{--  <div class="container">
		    <div class="row justify-content-center">
		        <div class="col-xl-8 col-md-12 col-sm-12">
		            <div class="logincontent">



		                <div class="loginright">
		                    <h2>Login</h2>

		                    <div class="welcomebox">
		                        <h3>Welcome!</h3>
		                        <p>Enter your details and start journey with us</p>
		                    </div>

		                    <div class="login_icon">
		                        <img src="{{asset('public/assets/images/loginicon.svg')}}" alt="">
		                    </div>


		                </div>

		                <div class="loginleft">
		                	<h3 class="mb-3">Login Your Account</h3>
		                    <form id="login_form">
		                        <div class="form-group">
		                            <label>Username</label>
		                            <input type="text" class="form-control" name="username">
		                             <div class="is-invalid username"></div>
		                        </div>

		                        <div class="form-group">
		                            <label>Password</label>
		                            <input type="password" class="form-control" name="password">
		                            <div class="is-invalid password"></div>
                                    <div class="is-invalid custom_error"></div>
		                        </div>
		                        <div class="form-group">
		                        	<a href="{{route('user.forgot.password')}}">Forgot Password</a>
		                        </div>

		                       
		                        <button type="submit" class="login_btn">
		                            <span>Login</span>
		                        </button>
		                        <div style="text-align: center;margin-top: 15px;">
			                            <a href="{{route('user.register')}}">Create an Account</a>
			                        </div>
		                    </form>
		                </div>

		            </div>
		        </div>

		    </div>
		</div> --}}
		<livewire:frontend.user.login />
    </div>
    <!-- End Page Wrapper -->
   
            
@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection