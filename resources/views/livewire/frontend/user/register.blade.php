<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-md-12 col-sm-12">
            <div class="logincontent">



                <div class="loginright">
                    <h2>signup</h2>

                    <div class="welcomebox">
                        <h3>Welcome!</h3>
                        <p>Enter your details and start journey with us</p>
                    </div>

                    <div class="login_icon">
                        <img src="{{asset('public/assets/images/loginicon.svg')}}" alt="">
                    </div>


                </div>

                <div class="loginleft">
                    	<h4 class="mb-3">Create Your Account</h4>
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model.defer="name">
                             @error('name') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" wire:model.defer="email">
                             @error('email') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Mobile no</label>
                            <input type="text" class="form-control" wire:model.defer="phone" onkeypress="return number_check(this,event);" maxlength="10">
                             @error('phone') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Father's Name</label>
                            <input type="text" class="form-control" wire:model.defer="father_name">
                             @error('father_name') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Board</label>
                            <select class="form-select" wire:model="board_id">
                                <option value="">Select Board</option>
                                @if(count($boards)>0)
                                @foreach($boards as $key=>$board)
                                	<option value="{{$board->id}}" >{{$board->name}}</option>
                                @endforeach
                                @endif
                              </select>
                               @error('board_id') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Class </label>
                            <select class="form-select" wire:model="board_class_id">
                            	<option value="">Select Class</option>
                                @if(count($classes)>0)
                                @foreach($classes as $key=>$class)
                                	<option value="{{$class->id}}" >{{$class->name}}</option>
                                @endforeach
                                @endif
                              </select>
                               @error('board_class_id') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Address (Street/Village)</label>
                            <input type="text" class="form-control" wire:model.defer="address">
                             @error('address') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Post Office</label>
                            <input type="text" class="form-control" wire:model.defer="post_office">
                             @error('post_office') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Police Station</label>
                            <input type="text" class="form-control" wire:model.defer="ps">
                             @error('ps') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>District</label>
                            <input type="text" class="form-control" wire:model.defer="district">
                             @error('district') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>State</label>
                            <select wire:model.defer="state_id"  class="form-control">
                                <option value="">Select an State</option>
                                @if(count($states)>0)
                                @foreach($states as $key=>$state)
                                    <option value="{{$state->id}}">{{$state->state}}</option>
                                @endforeach
                                @endif
                            </select> 
                             @error('state_id') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Pin Code</label>
                            <input type="text" class="form-control" wire:model.defer="pin_code" onkeypress="return number_check(this,event);" maxlength="6">
                             @error('pin_code') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" wire:model.defer="password">
                             @error('password') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Confirm password</label>
                            <input type="password" class="form-control" wire:model.defer="password_confirmation">
                             @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Referral code</label>
                            <input type="text" class="form-control" wire:model.defer="referral_code">
                             @error('referral_code') <div class="error">{{ $message }}</div> @enderror
                        </div>


                        {{-- <button type="submit" class="login_btn">
                            <span>Register</span>
                        </button> --}}
                         <x-frontend.login-button name="Register"
                                        target="save"></x-frontend.login-button>
                        <div style="text-align: center;margin-top: 15px;">
                            Already a member? <a href="{{route('user.login')}}">Login</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>