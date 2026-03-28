 <div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-md-8 col-sm-12">
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
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" wire:model.defer="username">
                             @error('username') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" wire:model.defer="password">
                             @error('password') <div class="error">{{ $message }}</div> @enderror
                        </div>

                       
                        {{-- <button type="submit" class="login_btn">
                            <span>Login</span>
                        </button> --}}
                        <x-frontend.login-button name="Login"
                                        target="save"></x-frontend.login-button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>