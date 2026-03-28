<div>
   <!-- --------------- -->
  <div class="container">
     <div class="row">
        <div class="col-xl-3 col-md-3 col-sm-12">
           @include('frontend.includes.subject_list')
        </div>

        <div class="col-xl-6 col-md-6 col-sm-12">
           <div class="mid_content">
              <h1 class="pagetitle">Withdraw</h1>

              <!-- content_box -->
              <div class="content_box">  


                 <form wire:submit.prevent="save">
                    
                    <div class="mb-3">
                      <label for="" class="form-label">Bank Name</label>
                      <input type=" text" class="form-control" wire:model.defer="bank_name">
                       @error('bank_name') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                       <label for="" class="form-label">Branch Name</label>
                       <input type="text" class="form-control" wire:model.defer="branch_name">
                        @error('branch_name') <div class="error">{{ $message }}</div> @enderror
                     </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Account No</label>
                      <input type=" text" class="form-control" wire:model.defer="account_no" onkeypress="return number_check(this,event);">
                       @error('account_no') <div class="error">{{ $message }}</div> @enderror
                    </div>


                    <div class="mb-3">
                      <label for="" class="form-label">IFSC Code</label>
                      <input type="text" class="form-control" wire:model.defer="ifsc_code">
                       @error('ifsc_code') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                      <label for="" class="form-label">Reward Points</label>
                      <input type="text" class="form-control" wire:model.defer="point" onkeypress="return number_check(this,event);">
                       @error('point') <div class="error">{{ $message }}</div> @enderror
                    </div> 

                 <div class="col-xl-12 col-md-12 col-sm-12 text-center">
                    <button type="submit" class="exambtn">Submit</button>
                 </div>

              </form>
             
              </div>
              <!-- content_box -->
           </div>

           <div class="weeklybox">
              <a href="{{route('user.weekly.exam')}}" class="weekly1_btn">Weekly Test</a>
                  <a href="{{route('user.GroupExam.exam',['slug' =>$user->group->slug, 'test_type' =>'weekly'])}}" class="weekly2_btn">Group Weekly Test</a>
           </div>
        </div>


        @include('frontend.includes.profile_side_bar')
     </div>
  </div>
  <!-- --------------- -->



  @include('frontend.includes.exam_side_bar')
</div>
