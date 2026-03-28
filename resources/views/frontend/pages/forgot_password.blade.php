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
		                    <h2>Forgot Password</h2>

		                    <div class="welcomebox">
		                        <!-- <h3>Welcome!</h3> -->
		                       <!--  <p>Enter your email ID</p> -->
		                    </div>

		                    <div class="login_icon">
		                        <img src="{{asset('public/assets/images/loginicon.svg')}}" alt="">
		                    </div>


		                </div>

		                <div class="loginleft">
		                    <form id="forgot_password_form">
		                        <div class="form-group">
		                            <label>Email</label>
		                            <input type="text" class="form-control" name="email" required="" value="{{old('email')}}">
		                             <div class="is-invalid email"></div>
		                        </div>

		                       
		                        

		                       
		                        <button type="submit" class="login_btn">
		                            <span>Submit</span>
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