<div>
  <!-- --------------- -->
  <div class="container">
     <div class="row">
        <div class="col-xl-3 col-md-3 col-sm-12">
           <div class="widget_col">
              <h2 class="widge_ttitle">Subject </h2>
              <ul>
                  @if(count($subjects)>0)
	                @foreach($subjects as $key=>$subjectData)
	                    <li><a href="javascript:void(0)" class="{{$subject->id==$subjectData->id?'active':''}}" >{{$subjectData->name}}</a></li>
	                @endforeach
	                @else
	                	<li><a href="javascript:void(0)" >No Subject Found</a></li>
	                @endif
              </ul>
          </div>
        </div>

        <div class="col-xl-6 col-md-6 col-sm-12">
           <div class="mid_content">
              <h1 class="pagetitle">{{$subject->name}}</h1>

              @if($questionSet)
              <div class="examtimecol">
                 <div class="totaltime">Total Time - <span>{{$questionSet->total_time}} Min</span></div>
                 <div class="timecount">Per Question Time - {{$questionSet->time_per_question*60}} Sec</div>  
              </div>


              <form wire:submit.prevent="postQuiz">
              <!-- content_box -->
              <div class="content_box">
              	@if($question)
                 <div class="questioncol">

                    <h5><span>1.</span>  {!! $question->question !!}?</h5>

                    <ul>
                       <li>
                          <div class="form-check">
                             <input class="form-check-input" type="radio" name="question" id="question1">
                             <label class="form-check-label" for="question1">
                               {!! $question->option_a !!}
                             </label>
                           </div>
                       </li>

                       <li>
                          <div class="form-check">
                             <input class="form-check-input" type="radio" name="question" id="question2">
                             <label class="form-check-label" for="question2">
                                {!! $question->option_b !!}
                             </label>
                           </div>
                       </li>

                       <li>
                          <div class="form-check">
                             <input class="form-check-input" type="radio" name="question" id="question2">
                             <label class="form-check-label" for="question2">
                                {!! $question->option_c !!} 
                             </label>
                           </div>
                       </li>

                       <li>
                          <div class="form-check">
                             <input class="form-check-input" type="radio" name="question" id="question2">
                             <label class="form-check-label" for="question2">
                                {!! $question->option_d !!}
                             </label>
                           </div>
                       </li>



                    </ul>
                 </div>
                
                @endif

              
              
                 <div class="col-xl-12 col-md-12 col-sm-12 text-center">
                    <button type="button" class="exambtn">Submit</button>
                 </div>
             
              </div>
              <!-- content_box -->
              </form>
              @endif
           </div>

           <script>
            const toggleNotification = () => {
              
                window.setTimeout(function() { @this.postQuiz(); }, 3000);
              setTimeout(toggleNotification, 10000);
          }


      toggleNotification();

      
             /* window.onload=function(){
                window.setTimeout(function() { @this.postQuiz(); }, 3000);
              };*/
            </script>

           <div class="weeklybox">
              <a href="#" class="weekly1_btn">Weekly Test</a>
              <a href="#" class="weekly2_btn">Group Weekly Test</a>
           </div>
        </div>


        <div class="col-xl-3 col-md-3 col-sm-12">
           <div class="widget_col">
              <a class="widget_user">
                 <div class="widget_user_icon">
                    @if(isset($user->profile_photo_path))
                    <img src="{{asset('storage/app/public/'.$user->profile_photo_path) }}" alt="user">
                    @else
                    <img src="{{asset('public/assets/images/no_image.png')}}" alt="user">
                    @endif
                 </div>
                 <div class="widget_user_name">{{$user->name}}</div>
              </a>
           </div>

            <div class="widget_col">
              <h2 class="widge_ttitle">Profile </h2>
              <ul>
                  <li><a href="#">Reward Points - <span>4567</span></a></li>
                  <li><a href="#">Withdraw </a></li>
                  <li><a href="#">Group - ALFA</a></li>
                  <li><a href="#">Beata </a></li>
                  <li><a href="#">Your  Group</a></li>
              </ul>
            </div>
        </div>
     </div>
  </div>
  <!-- --------------- -->



  <!-- --------------- -->
  <div class="container mt-5">
     <div class="row">
        <div class="col-xl-9 col-md-9 col-sm-12">
           <div class="widget_col">
              <h2 class="widge_ttitle">Monthly Group Test – ALFA TEST</h2>

              <div class="testbox">
                 <a href="#" class="test1_btn">BEATA  TEST</a>
                 <a href="#" class="test2_btn">THETA TEST</a>
                 <a href="#" class="test3_btn">GAMA TEST</a>      
              </div>


          </div>
        </div>



        <div class="col-xl-3 col-md-3 col-sm-12">
           <a class="" href="">
              <img src="{{asset('public/images/adv.png')}}" alt="">
           </a>
        </div>
     </div>
  </div>
  <!-- --------------- -->
</div>
