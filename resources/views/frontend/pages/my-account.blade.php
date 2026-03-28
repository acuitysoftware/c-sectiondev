@extends('frontend.layouts.user-app')
@section('css')
@endsection

@section('content')


<!-- logoarea -->
    @include('frontend.includes.top_section')
<!-- logoarea -->



<!-- Start Page Wrapper -->
   <div class="page-wrapper">

      <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="L_common_W">
                            <div class="usercol">
                                <div class="user_img">@if(isset($user->profile_photo_path))
				                    <img src="{{asset('storage/app/public/'.$user->profile_photo_path) }}" alt="user">
				                    @else
				                    <img src="{{asset('public/assets/images/no_image.png')}}" alt="user">
				                    @endif</div>
                                <h5>{{$user->name}}</h5>
                            </div>
                            
                            <div id="filter" class="innerfilter">
                                <ul>              
                                    <li><a class="selected" data-filter=".psdbox" href="">My Account</a></li>
                                    <li><a data-filter=".edit_profile" href="">Edit Profile</a></li>
                                    <li><a data-filter=".exam-result" href="">My Exam result</a></li>
                                    <li><a data-filter=".my-reward" href="">My Reward</a></li>
                                    <li><a data-filter=".my-withdraw" href="">My Withdraw</a></li>
                                    <li><a data-filter=".changepassword" href="">Change Password</a></li>
                                    <li><a href="javascript:void(0)" onclick="event.preventDefault();
                                      document.getElementById('user-logout-form').submit();">Logout</a></li>       
                                </ul>
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        
                            <div id="content">
                                
                                
                                <!--tab1-->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 psdbox">
                                  <div class="mid_content">
                                              <h1 class="pagetitle">My Account</h1>

                                              

                                              <div class="content_box"> 
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                                            <div class="Acountdet">
                                                <div class="Acname">Name : <span>{{$user->name}}</span></div>                                                
                                                <div class="Acname">Phone : <span> {{$user->phone}}</span></div>
                                                <div class="Acname">Email ID : <span> {{$user->email}}</span></div>
                                            <div class="Acname">Address : <span>{{$user->address}} {{$user->post_office}} {{$user->ps}} {{$user->district}} {{$user->state?$user->state->state_name:""}} {{$user->pin_code}}</span></div>
                                            </div>
                                        
                                    
                                            <!-- <button type="button" class="tcBTN"><span>Add Address</span></button> -->
                                        </div>
                                    </div>                                                    
                                    </div>                                                    
                                    </div>                                                    
                                </div>
                                <!--tab1 end-->

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 edit_profile" >
                                	<div class="mid_content">
                                              <h1 class="pagetitle">Edit Account</h1>

                                              

                                              <div class="content_box"> 
                            
                            <form method="post" action="{{route('user.profile.save')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">  
                                    <div class="Acountdet_name"> 
                                        <label>Name</label>                                     
                                        <input type="text" name="name" placeholder="Name" class="Acpass" value="{{$user->name}}" required="">
                                        @error('name') <div class="error">{{ $message }}</div> @enderror
                                        <div class="is-invalid name"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">  
                                    <div class="Acountdet_name"> 
                                        <label>Father's Name</label>                                     
                                        <input type="text" name="father_name" placeholder="Father's Name" class="Acpass" value="{{$user->father_name}}" required="">
                                        @error('father_name') <div class="error">{{ $message }}</div> @enderror
                                        <div class="is-invalid father_name"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Phone     </label>                                
                                        <input type="text" name="phone" placeholder="Phone" class="Acpass" value="{{$user->phone}}" onkeypress="return number_check(this,event);" maxlength="10" required="">
                                        @error('phone') <div class="error">{{ $message }}</div> @enderror
                                        <div class="is-invalid phone"></div>
                                    </div>     
                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Profile Image </label>                                    
                                        <input type="file" id="profile_image" name="profile_image"  class="Acpass"  accept="image/png,image/jpg,image/jpeg">
                                        @error('profile_image') <div class="error">{{ $message }}</div> @enderror
                                        <div class="is-invalid profile_image"></div>
                                    </div>     
                                </div>    
                                 
                                @if(isset($user->profile_photo_path))
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                        <div class="user_img">
                                            <img src="{{asset('storage/app/public/'.$user->profile_photo_path) }}"  alt="user">
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Address </label>
                                        <textarea name="address" rows="6" placeholder="Address" class="Acpass"  required="">{{$user->address}}</textarea>
                                        @error('address') <div class="error">{{ $message }}</div> @enderror
                                        <div class="is-invalid address"></div>
                                    </div>     
                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Post Office  </label>                                   
                                        <input type="text" name="post_office" placeholder="Post Office" class="Acpass" value="{{$user->post_office}}" required="">
                                        @error('post_office') <div class="error">{{ $message }}</div> @enderror
                                        <div class="is-invalid post_office"></div>
                                    </div>     
                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Police Station  </label>                                   
                                        <input type="text" name="ps" placeholder="Police Station" class="Acpass" value="{{$user->ps}}" required="">
                                        @error('ps') <div class="error">{{ $message }}</div> @enderror
                                        <div class="is-invalid ps"></div>
                                    </div>     
                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>District  </label>                                   
                                        <input type="text" name="district" placeholder="District" class="Acpass" value="{{$user->district}}" required="">
                                        @error('district') <div class="error">{{ $message }}</div> @enderror
                                        <div class="is-invalid district"></div>
                                    </div>     
                                    
                                </div>

                                
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Pin Code  </label>                                   
                                        <input type="text"  placeholder="Pin Code" class="Acpass" name="pin_code" value="{{$user->pin_code}}" required="" onkeypress="return number_check(this,event);" maxlength="6">
                                        @error('pin_code') <div class="error">{{ $message }}</div> @enderror
                                        <div class="is-invalid pin_code"></div>
                                    </div>     
                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>State </label> 
                                        <select name="state_id" class="Acpass" required>
                                            <option value="">Select an option</option>
                                            @if(count($states)>0)
                                            @foreach($states as $key=>$state)
                                                <option value="{{$state->id}}" @if($user->state_id == $state->id) selected @endif>{{$state->state}}</option>
                                            @endforeach
                                            @endif
                                        </select>                                  
                                        
                                        @error('state_id') <div class="error">{{ $message }}</div> @enderror
                                        <div class="is-invalid state_id"></div>
                                    </div>     
                                    
                                </div>

                                

                                
                            </div>                                    
                                <button type="submit" class="tcBTN"><span>Submit</span></button>
                            </form> 
                        </div>
                        </div>
                        </div>
                                <!--tab2-->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 changepassword">
                                  <div class="mid_content">
                                              <h1 class="pagetitle">Change Password</h1>

                                              

                                              <div class="content_box"> 
                                    
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                        <form method="post" action="{{route('user.change.password.save')}}">
                            			@csrf 
                                             <div class="Acountdet_name"> 
		                                        <label>Old Password  </label>                                    
		                                        <input type="password" name="old_password" placeholder="******" class="Acpass" required="">
		                                        @error('old_password') <div class="error">{{ $message }}</div> @enderror
		                                    </div>    
		                                    <div class="Acountdet_name"> 
		                                        <label>New Password   </label>                                  
		                                        <input type="password" name="password" placeholder="******" class="Acpass" required="">
		                                         @error('password') <div class="error">{{ $message }}</div> @enderror
		                                    </div>

		                                    <div class="Acountdet_name"> 
		                                        <label>Confirm Password </label>                                     
		                                        <input type="password" name="password_confirmation" placeholder="******" class="Acpass" required="">
		                                        @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
		                                    </div>

                                            <button type="button" class="tcBTN"><span>Change Password</span></button>
                                            </form>

                                        </div>
                                    </div>                                    
                                    </div>                                    
                                    </div>                                    
                                </div>
                                <!--tab2 end-->


                                <!--tab3-->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 exam-result">
                                    
                                    
                                   

                                            <div class="mid_content">
                                              <h1 class="pagetitle">My Exam Result</h1>

                                              

                                              <div class="content_box"> 

                                            <div class="table-responsive">  
                                            <table class="table table-bordered">
                                              <thead>
                                                <tr>
                                                  <th>Subject</th>
                                                  <th>Part</th>
                                                  <th>Pass/Fail</th>
                                                  <th>Percentage</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @if(count($exams)>0)
                                				@foreach($exams as $exam)

                                                <tr>
                                                  <td>
                                                    @if($exam->subject)
                                                        {{$exam->subject->name}}
                                                    @else
                                                        {{$exam->exam_type=='Single'?'All Subject':$exam->exam_type}}
                                                    @endif
                                                  </td>
                                                  <td>
                                                    @if($exam->chapter)
                                                        {{$exam->chapter->name}}
                                                    @else
                                                        {{$exam->test_type}}
                                                    @endif
                                                  </td>
                                                  <td>{{$exam->is_passed==1?'Passed':'Failed'}}</td>
                                                  <td>{{$exam->percentage?$exam->percentage:'0'}}%</td>
                                                </tr>
                                                @endforeach
				                                @else
				                                <tr>
				                                	<td colspan="4" style="text-align: center;">No records available</td>
				                                </tr>
				                                            
				                                @endif
                                                
                                               
                                              </tbody>
                                            </table>                                
                                        </div>
                                        </div>
                                         
                                    </div>
                                </div>
                                <!--tab3 end-->

                                <!--tab3-->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-reward">
                                    
                                    
                                   

                                            <div class="mid_content">
                                              <h1 class="pagetitle">My Reward</h1>

                                              

                                              <div class="content_box"> 

                                            <div class="table-responsive">  
                                            <table class="table table-bordered">
                                              <thead>
                                                <tr>
                                                  <th>Date</th>
                                                  <th>Reason</th>
                                                  <th>Student Name</th>
                                                  <th>Reward Point</th>
                                                  <!-- <th>Status</th> -->
                                                </tr>
                                              </thead>
                                              <tbody>
                                              	@if(count($points)>0)
                                				@foreach($points as $point)
                                                <tr>
                                                  <td>{{$point->created_at->format('d/m/Y')}}</td>
                                                  @php
                                                      $reason = "";
                                                      if($point->type =="1"){
                                                          $reason = "Join";

                                                      }
                                                      elseif($point->type =="2"){
                                                          $reason = "Exam Passed";

                                                      }
                                                      elseif($point->type =="3"){
                                                          $reason = "Streak Maintain";

                                                      }
                                                  @endphp
                                                  <td>{{$reason}}</td>
                                                  <td>{{$point->joinUse?$point->joinUser->name:""}}</td>
                                                  <td>{{$point->reward_points}}</td>
                                                  <!-- <td>@if($point->status == '0')
                                                        Pending
                                                    @elseif($point->status == '1')
                                                        Approved
                                                    @elseif($point->status == '2')
                                                        Cancelled
                                                    @endif</td> -->
                                                </tr>
                                                @endforeach
				                                @else
				                                <tr>
				                                	<td colspan="4" style="text-align: center;">No records available</td>
				                                </tr>
				                                            
				                                @endif
                                                
                                               
                                              </tbody>
                                            </table>                                
                                        </div>
                                        </div>
                                         
                                    </div>
                                </div>
                                <!--tab3 end-->

                                <!--tab3-->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-withdraw">
                                    
                                    
                                   

                                            <div class="mid_content">
                                              <h1 class="pagetitle">My Withdrawals</h1>

                                              

                                              <div class="content_box"> 

                                            <div class="table-responsive">  
                                            <table class="table table-bordered">
                                              <thead>
                                                <tr>
                                                  <th>Date</th>
                                                  <th>Student Name</th>
                                                  <th>Reward Point</th>
                                                  <th>Status</th>
                                                  <!-- <th>Status</th> -->
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @php
                                                    $total_withdraws =0;
                                                @endphp
                                                @if(count($withdraws)>0)
                                                @foreach($withdraws as $withdraw)
                                                @php
                                                    $total_withdraws+=$withdraw->reward_points;
                                                @endphp
                                                <tr>
                                                  <td>{{$withdraw->created_at->format('d/m/Y')}}</td>
                                                  <td>{{$withdraw->user->name}}</td>
                                                  <td>{{$withdraw->reward_points}}</td>
                                                  <td>@if($withdraw->status == '0')
                                                        Pending
                                                    @elseif($withdraw->status == '1')
                                                        Approved
                                                    @elseif($withdraw->status == '2')
                                                        Cancelled
                                                    @endif</td>
                                                </tr>
                                                
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="4" style="text-align: center;">No records available</td>
                                                </tr>
                                                            
                                                @endif
                                                
                                               
                                              </tbody>
                                            </table>                                
                                        </div>
                                        </div>
                                         
                                    </div>
                                </div>
                                <!--tab3 end-->
                        
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