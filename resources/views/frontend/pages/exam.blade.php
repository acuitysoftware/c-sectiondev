@extends('frontend.layouts.user-app')
@section('css')
@endsection

@section('content')


<!-- logoarea -->
    @include('frontend.includes.top_section')
<!-- logoarea -->



 <!-- Start Page Wrapper -->
   <div class="page-wrapper">

      <div>
		  <!-- --------------- -->
		  <div class="container">
		     <div class="row">
		        <div class="col-xl-3 col-md-3 col-sm-12">
		           @include('frontend.includes.subject_list')
		        </div>

		        <div class="col-xl-6 col-md-6 col-sm-12" id="exam-start" style="display: none;">
		           <div class="mid_content">
		              <h1 class="pagetitle">{{$subject->name}}</h1>

		              @if(@$questionSet)
		              <div class="examtimecol">
		                 <div class="totaltime">Remaining Time - <span class="countdown"> Min</span></div>
		                 <div class="timecount">Total Time - <span class="counter">{{@$questionSet->total_time}}</span> Min</div>  
		              </div>


		              <form wire:submit.prevent="postQuiz">
		              <!-- content_box -->
		              <div class="content_box">
		              	@if($question)
		                 <div class="questioncol">

		                    <h5 id="question"><span>1.</span>  {!! @$question->question !!}?</h5>

		                    <ul>
		                       <li>
		                          <div class="form-check">
		                             <input class="form-check-input" type="radio" name="answer" id="answer1" value="{!! @$question->option_a !!}">
		                             <label class="form-check-label" for="answer1" id="lableAnswer1">
		                               {!! @$question->option_a !!}
		                             </label>
		                           </div>
		                       </li>

		                       <li>
		                          <div class="form-check">
		                             <input class="form-check-input" type="radio" name="answer" id="answer2" value="{!! @$question->option_b !!}">
		                             <label class="form-check-label" for="answer2" id="lableAnswer2">
		                                {!! @$question->option_b !!}
		                             </label>
		                           </div>
		                       </li>

		                       <li>
		                          <div class="form-check">
		                             <input class="form-check-input" type="radio" name="answer" id="answer3" value="{!! @$question->option_c !!}">
		                             <label class="form-check-label" for="answer3" id="lableAnswer3">
		                                {!! @$question->option_c !!} 
		                             </label>
		                           </div>
		                       </li>

		                       <li>
		                          <div class="form-check">
		                             <input class="form-check-input" type="radio" name="answer" id="answer4" value="{!! @$question->option_d !!}">
		                             <label class="form-check-label" for="answer4" id="lableAnswer4">
		                                {!! @$question->option_d !!}
		                             </label>
		                           </div>
		                       </li>



		                    </ul>
		                 </div>
		                 <input type="hidden" name="question_set_id" id="question_set_id" value="{!! @$question->id !!}">
		                <input type="hidden" name="previousAnswerId" id="previousAnswerId" >
		                @endif

		              
		              
		                 <div class="col-xl-12 col-md-12 col-sm-12 text-center">
		                    <button type="button" class="exambtn" id="previousBtn" style="display: none;">Previous</button>
		                    <button type="button" class="exambtn" id="submitBtn">Next</button>
		                 </div>
		             
		              </div>
		              <!-- content_box -->
		              </form>
		              @endif
		           </div>



		           <div class="weeklybox">
		              <a href="{{route('user.weekly.exam')}}" class="weekly1_btn">Weekly Test</a>
                  <a href="{{route('user.GroupExam.exam',['slug' =>$user->group->slug, 'test_type' =>'weekly'])}}" class="weekly2_btn">Group Weekly Test</a>>
		           </div>
		        </div>

		        <div class="col-xl-6 col-md-6 col-sm-12" id="start-div">
		           <div class="mid_content">

		           
		              <!-- content_box -->
		              <div class="content_box">
		              	

		              
		              
		                 <div class="col-xl-12 col-md-12 col-sm-12 text-center">
		                    <button type="button" class="exambtn" id="startBtn">Start Exam</button>
		                 </div>
		             
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


   </div>
   <!-- End Page Wrapper -->

            
@endsection

@section('script')
   <script type="text/javascript">



   	
   	var sec = "{{@$questionSet->time_per_question}}"
   	var question_set_id = "{{@$questionSet->id}}"
   	var subject_id = "{{$subject->id}}"
   	var charper_id = "{{$subject->id}}"
   	var new_time = parseInt(sec)*60;
   	var offset = 1;
   	let timeCounter = new_time;
   	var myInterval;


$('#previousBtn').click(function(){
  offset-=1;
  var previousAnswerId = $('#previousAnswerId').val();
  $.ajax({
            type: "POST",
              url:"{{route('get.previous.question')}}",
              data: {
                'question_set_id': question_set_id,
                'previousAnswerId': previousAnswerId,
                'offset': offset,
                  '_token':'{{@csrf_token()}}'
              },
              //dataType: "JSON",
              success: function(jsn) {
                console.log(jsn);
                $('input:radio[name=answer]').each(function () { $(this).prop('checked', false); });
                if(jsn.status == 'true')
                {
                  $('#question_set_id').last().val(jsn.data.id);
                	$('#question').last().text(jsn.data.question);
                	$('#lableAnswer1').last().text(jsn.data.option_a);
                	$('#answer1').last().val(jsn.data.option_a);
                	$('#lableAnswer2').last().text(jsn.data.option_b);
                	$('#answer2').last().val(jsn.data.option_b);
                	$('#lableAnswer3').last().text(jsn.data.option_c);
                	$('#answer3').last().val(jsn.data.option_c);
                	$('#lableAnswer4').last().text(jsn.data.option_d);
                	$('#answer4').last().val(jsn.data.option_d);
                	$('#previousAnswerId').last().val(jsn.previousAnswerId);
                    console.log(jsn.previousAnswer);
                    console.log(offset);
                    if(offset == 1)
                    {
                      $('#previousBtn').hide();
                    }
                    if(jsn.previousAnswer)
                    {
                      if(jsn.previousAnswer == jsn.data.option_a)
                      {
                        console.log('1');
                        $("#answer1").prop("checked", true);
                      }
                      else if(jsn.previousAnswer == jsn.data.option_b)
                      {
                        console.log('21');
                        $("#answer2").prop("checked", true);
                      }
                      else if(jsn.previousAnswer == jsn.data.option_c)
                      {
                        console.log('3');

                        $("#answer3").prop("checked", true);
                      }
                      else if(jsn.previousAnswer == jsn.data.option_d)
                      {
                        console.log('4');
                        $("#answer4").prop("checked", true);
                      }
                    }

                }
                else if(jsn.status == 'complete')
                {
                  window.location.href = "{{route('user.account')}}";
                }
                else{
                  toastr["error"](jsn.message);
                }
                
              }
            })
});
    

	
    $('#submitBtn').click(function(){
    
    	var question_id = $('#question_set_id').val();
		var submit_answer = $('input[name="answer"]:checked').val();
		
    	 $.ajax({
            type: "POST",
              url:"{{route('answer.submit')}}",
              data: {
              	'question_set_id': question_set_id,
              	'question_id': question_id,
	            'submit_answer': submit_answer,
              	'offset': offset,
                  '_token':'{{@csrf_token()}}'
              },
              //dataType: "JSON",
              success: function(jsn) {
                console.log(jsn);
                $('input:radio[name=answer]').each(function () { $(this).prop('checked', false); });
                if(jsn.status == 'true')
                {
                	$('#previousBtn').show();
                	$('#question_set_id').last().val(jsn.data.id);
                	$('#previousAnswerId').last().val(jsn.previousAnswerId);
                	$('#question').last().text(jsn.data.question);
                	$('#lableAnswer1').last().text(jsn.data.option_a);
                	$('#answer1').last().val(jsn.data.option_a);
                	$('#lableAnswer2').last().text(jsn.data.option_b);
                	$('#answer2').last().val(jsn.data.option_b);
                	$('#lableAnswer3').last().text(jsn.data.option_c);
                	$('#answer3').last().val(jsn.data.option_c);
                	$('#lableAnswer4').last().text(jsn.data.option_d);
                	$('#answer4').last().val(jsn.data.option_d);
                  	offset+=1;
                    clearInterval(timeCounter);
			    	clearInterval(myInterval);
			    	span = document.getElementById("count");
					span.innerHTML = 0;

                }
                else if(jsn.status == 'complete')
                {
                	toastr["success"]('Exam completed successfully');
                	window.location.href = "{{route('user.account')}}";
                }
                else{
                	toastr["error"](jsn.message);
                }
                
              }
            })
    });
    $('#startBtn').click(function(){
    	$('#start-div').hide();
    	$('#exam-start').show();

    	var timer2 = "{{@$questionSet->total_time}}:00";
		var interval = setInterval(function() {
	    var timer = timer2.split(':');
	    //by parsing integer, I avoid all extra string processing
	    var minutes = parseInt(timer[0], 10);
	    var seconds = parseInt(timer[1], 10);
	    --seconds;
	    minutes = (seconds < 0) ? --minutes : minutes;
	    seconds = (seconds < 0) ? 59 : seconds;
	    seconds = (seconds < 10) ? '0' + seconds : seconds;
	    //minutes = (minutes < 10) ?  minutes : minutes;
	    if (minutes < 0) {
	        clearInterval(interval);
	        var question_id = $('#question_set_id').val();
			var submit_answer = $('input[name="answer"]:checked').val();
	        $.ajax({
            type: "POST",
              url:"{{route('exam.final.answer.submit')}}",
              data: {
              	'question_set_id': question_set_id,
              	'question_id': question_id,
	            'submit_answer': submit_answer,
              	'offset': offset,
                  '_token':'{{@csrf_token()}}'
              },
              //dataType: "JSON",
              success: function(jsn) {
                console.log(jsn);
                $('input:radio[name=answer]').each(function () { $(this).prop('checked', false); });
                if(jsn.status == 'true')
                {
                	$('#question_set_id').last().val(jsn.data.id);
                	$('#question').last().text(jsn.data.question);
                	$('#lableAnswer1').last().text(jsn.data.option_a);
                	$('#answer1').last().val(jsn.data.option_a);
                	$('#lableAnswer2').last().text(jsn.data.option_b);
                	$('#answer2').last().val(jsn.data.option_b);
                	$('#lableAnswer3').last().text(jsn.data.option_c);
                	$('#answer3').last().val(jsn.data.option_c);
                	$('#lableAnswer4').last().text(jsn.data.option_d);
                	$('#answer4').last().val(jsn.data.option_d);
                  	offset+=1;
                    clearInterval(timeCounter);
			    	clearInterval(myInterval);
			    	span = document.getElementById("count");
					span.innerHTML = 0;

                }
                else if(jsn.status == 'complete')
                {
                	toastr["success"]('Exam completed successfully');
                	window.location.href = "{{route('user.account')}}";
                }
                else{
                	toastr["error"](jsn.message);
                }
                
              }
            })

	    } else {
	        $('.countdown').html(minutes + ':' + seconds);
	        timer2 = minutes + ':' + seconds;
	    } 
	}, 1000);
    })
   </script>
@endsection