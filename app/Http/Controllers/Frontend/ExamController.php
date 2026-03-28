<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Hash;
use App\Models\Banner;
use App\Models\Payment;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Question;
use App\Models\RewardPoint;
use App\Models\QuestionSet;
use App\Models\ClassGroup;
use App\Models\Board;
use App\Models\BoardClass;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\TempExam;
use App\Models\TempExamQuestion;
use App\Models\Withdraw;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ExamController extends Controller
{
	public function index($id, $slug, $chapter_id, $chapter_slug)
    {
    	$data['title'] = 'Exam';
        $user = Auth::user();
        $data['subject'] = Subject::where('id',$id)->where('slug', $slug)->first();
        $data['chapter'] = Chapter::where('id',$chapter_id)->where('slug', $chapter_slug)->first();
        $data['user'] = $user;
        $data['subjects'] = Subject::where('board_class_id', $data['user']->board_class_id)->get();
        $data['questionSet'] = QuestionSet::where('active', 1)->where('chapter_id', $data['chapter']->id)->first();
        
        $data['question'] = Question::where('question_set_id', $data['questionSet']->id)->first();
        TempExam::where(['user_id' =>Auth::user()->id])->delete();
        if($data['subject'] && $data['chapter'])
        {
            $withdraw_points = Withdraw::where('user_id', $user->id)->where('status', '!=' ,'2')->sum('reward_points');

            $total_points = RewardPoint::where([
                        'user_id'=>$user->id,
                    ])->sum('reward_points');

            $data['total_points']= ($total_points-$withdraw_points);
            return view('frontend.pages.exam',$data);
            /*return view('frontend.pages.exam',['subject'=>$subject, 'chapter' => $chapter]);*/
        }
        return redirect()->route('user.profile')->with('error', 'Data not found');
        
    	
    }
    public function weeklyExam()
    {
        $user = Auth::user();
        
        $today = date('Y-m-d');
        $data['title'] = 'Exam';
        $data['subject'] = null;
        $data['user'] = $user;
        $ids =[];
        $question_set_ids = $user->exams()->where('is_passed', 1)->pluck('question_set_id')->toArray();
        if(count($question_set_ids))
        {
            foreach ($question_set_ids as $key => $id) {
                $ids[$key] = $id;
                
            }
        }
        $data['subjects'] = Subject::where('board_class_id', $data['user']->board_class_id)->get();
        $data['questionSet'] = QuestionSet::where('active', 1)->whereNotIn('id', $ids)->where('board_class_id', $user->board_class_id)->where('exam_type', 'Single')->where('test_type', 'Weekly')->where('start_date','>=' , $today)->whereNull('chapter_id')->first();

        $data['question'] = null;
        if($data['questionSet'])
        {

            //$data['question'] = Question::where('question_set_id', $data['questionSet']->id)->first();
        }
        TempExam::where(['user_id' =>Auth::user()->id])->delete();
        if($data['questionSet'])
        {

            $withdraw_points = Withdraw::where('user_id', $user->id)->where('status', '!=' ,'2')->sum('reward_points');

            $total_points = RewardPoint::where([
                        'user_id'=>$user->id,
                    ])->sum('reward_points');

            $data['total_points']= ($total_points-$withdraw_points);
            $data['test_type']= 'Weekly';
            $data['exam_type']= 'Single';
            return view('frontend.pages.weekly_exam',$data);
            /*return view('frontend.pages.exam',['subject'=>$subject, 'chapter' => $chapter]);*/
        }
        return redirect()->back()->with('error', 'Exam not available');
        /*return redirect()->route('user.profile')->with('error', 'Exam not available');*/
            
        
        
        
    }

    public function weeklyGroupExam()
    {
       
        $today = date('Y-m-d');
        $data['title'] = 'Exam';
        $user = Auth::user();
        $data['subject'] = null;
        $data['user'] = $user;
        $ids =[];
        $question_set_ids = $user->exams()->where('is_passed', 1)->pluck('question_set_id')->toArray();
        if(count($question_set_ids))
        {
            foreach ($question_set_ids as $key => $id) {
                $ids[$key] = $id;
                
            }
        }
        $data['subjects'] = Subject::where('board_class_id', $data['user']->board_class_id)->get();
        $data['questionSet'] = QuestionSet::where('active', 1)->whereNotIn('id', $ids)->where('board_class_id', $user->board_class_id)->where('exam_type', 'Group')->where('test_type', 'Weekly')->where('start_date','>=' , $today)->whereNull('chapter_id')->orderBY('start_date','asc')->orderBY('time','asc')->first();

        $data['question'] = null;
        if($data['questionSet'])
        {

            //$data['question'] = Question::where('question_set_id', $data['questionSet']->id)->first();
        }
        TempExam::where(['user_id' =>Auth::user()->id])->delete();
        if($data['questionSet'])
        {

            $withdraw_points = Withdraw::where('user_id', $user->id)->where('status', '!=' ,'2')->sum('reward_points');

            $total_points = RewardPoint::where([
                        'user_id'=>$user->id,
                    ])->sum('reward_points');

            $data['total_points']= ($total_points-$withdraw_points);
            $data['test_type']= 'Weekly';
            $data['exam_type']= 'Group';
            return view('frontend.pages.weekly_exam',$data);
            /*return view('frontend.pages.exam',['subject'=>$subject, 'chapter' => $chapter]);*/
        }
        return redirect()->back()->with('error', 'Exam not available');
        /*return redirect()->route('user.profile')->with('error', 'Exam not available');*/
            
        
        
        
    }

   

    public function GroupExam($group_name, $test_type)
    {
         
        $user = Auth::user();
        $group = ClassGroup::where('slug', $group_name)->where('board_class_id', $user->board_class_id)->first();

        if(is_null($group))
        {
            return redirect()->route('user.profile')->with('error', 'Something went wrong');
        }
        $today = date('Y-m-d');
        $data['title'] = 'Exam';
        $data['subject'] = null;
        $data['user'] = $user;
        $data['group_name'] = $group_name;
        $ids =[];
        $question_set_ids = $user->exams()->where('is_passed', 1)->pluck('question_set_id')->toArray();
        if(count($question_set_ids))
        {
            foreach ($question_set_ids as $key => $id) {
                $ids[$key] = $id;
                
            }
        }

        $data['subjects'] = Subject::where('board_class_id', $data['user']->board_class_id)->get();
        $data['questionSet'] = QuestionSet::where('active', 1)->whereNotIn('id', $ids)->where('board_class_id', $user->board_class_id)->where('class_group_id', $user->class_group_id)->where('exam_type', 'Group')->where('test_type', ucfirst($test_type))->where('start_date','>=' , $today)->whereNull('chapter_id')->orderBY('start_date','asc')->orderBY('time','asc')->first();

        //dd($data['questionSet']);
        $data['question'] = null;
        if($data['questionSet'])
        {

            //$data['question'] = Question::where('question_set_id', $data['questionSet']->id)->first();
        }
        TempExam::where(['user_id' =>Auth::user()->id])->delete();
        if($data['questionSet'])
        {

            $withdraw_points = Withdraw::where('user_id', $user->id)->where('status', '!=' ,'2')->sum('reward_points');

            $total_points = RewardPoint::where([
                        'user_id'=>$user->id,
                    ])->sum('reward_points');

            $data['total_points']= ($total_points-$withdraw_points);
            $data['test_type']= $test_type;
            $data['exam_type']= 'Group';
            return view('frontend.pages.group-exam',$data);
            /*return view('frontend.pages.exam',['subject'=>$subject, 'chapter' => $chapter]);*/
        }
        return redirect()->back()->with('error', 'Exam not available');
        /*return redirect()->route('user.profile')->with('error', 'Exam not available');*/
            
        
        
        
    }

    public function finalAnswerSubmit(Request $request){

        /*try {*/
            $user = Auth::user();
            $previousAnswerId = null;
            
            $today = date('Y-m-d H:i:s');
            $questionSet = QuestionSet::where('active', 1)->where('id', $request->question_set_id)->first();
            if(is_null($questionSet))
            {
                return response()->json([
                    'status' => 'not-start',
                    'message' => 'Exam not start currenly.Please check correct date time',
                ]);
            }
            $is_exam = TempExam::where([
                    'user_id' =>$user->id,
                    'question_set_id' =>$questionSet->id,
                ])->first();
            if(isset($request->question_id))
            {


                

                    if(is_null($is_exam))
                    {
                       $is_exam = TempExam::create([
                            'user_id' =>$user->id,
                            'question_set_id' =>$questionSet->id,
                            'exam_type' =>$questionSet->exam_type,
                            'test_type' =>$questionSet->test_type,
                            'pass_marks' =>$questionSet->pass_marks,
                            'start_date' =>$questionSet->start_date,
                            'time' =>$questionSet->time,
                            'class_group_id' =>$user->class_group_id,
                        ]);
                    }

                    $getQuestion = Question::where('id', $request->question_id)->first();
                    
                     $status = 0;
                    if(isset($request->submit_answer))
                    {
                        if($getQuestion->correct_answer == $request->submit_answer)
                        {
                            $status = 1;
                        }
                    }
                 
                    $is_answer_submit = TempExamQuestion::where([
                        'temp_exam_id' =>$is_exam->id,
                        'question' =>$getQuestion->question,
                    ])->first();

                    if(is_null($is_answer_submit))
                    {
                        $previousAnswer = TempExamQuestion::create([
                            'temp_exam_id' =>$is_exam->id,
                            'question' =>$getQuestion->question,
                            'option_a' =>$getQuestion->option_a,
                            'option_b' =>$getQuestion->option_b,
                            'option_c' =>$getQuestion->option_c,
                            'option_d' =>$getQuestion->option_d,
                            'correct_answer' =>$getQuestion->correct_answer,
                            'answer' =>@$request->submit_answer,
                            'status' =>$status,
                        ]); 
                    $previousAnswerId = $previousAnswer->id;
                    }
                    else{
                        $is_answer_submit->update([
                                'correct_answer' =>$getQuestion->correct_answer,
                                'answer' =>@$request->submit_answer,
                                'status' =>$status,
                            ]); 

                        $previousAnswerId = $is_answer_submit->id;
                    }


                    
                /*}*/
            }
            
                
                
                if($is_exam)
                {

                    $exam = Exam::create([
                        'user_id' =>$user->id,
                        'board_id' =>$user->board_id,
                        'board_class_id' =>$user->board_class_id,
                        'subject_id' =>$questionSet->subject_id,
                        'chapter_id' =>$questionSet->chapter_id,
                        'question_set_id' =>$is_exam->question_set_id,
                        'exam_type' =>$questionSet->exam_type,
                        'test_type' =>$questionSet->test_type,
                        'pass_marks' =>$questionSet->pass_marks,
                        'pass_marks_percentage' =>$questionSet->pass_marks_percentage,
                        'start_date' =>$questionSet->start_date,
                        'time' =>$questionSet->time,
                        'class_group_id' =>$user->class_group_id,
                    ]);
                    $questionData = TempExamQuestion::where(['temp_exam_id' =>$is_exam->id,])->get();

                    $count = 0;
                    $questionCount = 0;
                    if(count($questionData))
                    {
                        foreach ($questionSet->questions as $key => $value) {

                            if(isset($questionData[$key]) && $value->question == $questionData[$key]->question)
                            {
                                $questionCount+=1;
                                if($questionData[$key]->status ==1)
                                {
                                    $count+=1;
                                }
                                ExamQuestion::create([
                                    'exam_id' =>$exam->id,
                                    'question' =>$value->question,
                                    'option_a' =>$value->option_a,
                                    'option_b' =>$value->option_b,
                                    'option_c' =>$value->option_c,
                                    'option_d' =>$value->option_d,
                                    'correct_answer' =>$value->correct_answer,
                                    'answer' => $questionData[$key]->answer,
                                    'status' =>$questionData[$key]->status,
                                ]); 
                            }
                            else{
                                ExamQuestion::create([
                                    'exam_id' =>$exam->id,
                                    'question' =>$value->question,
                                    'option_a' =>$value->option_a,
                                    'option_b' =>$value->option_b,
                                    'option_c' =>$value->option_c,
                                    'option_d' =>$value->option_d,
                                    'correct_answer' =>$value->correct_answer,
                                    'answer' => null,
                                    'status' =>0,
                                ]); 
                            }

                            
                        }
                        $setting = Setting::first();
                        $percentage = round((($count*100)/$questionCount),2);
                        if($percentage >= $exam->pass_marks_percentage)
                        {
                            $exam->update([
                                'percentage' => $percentage,
                                'is_passed' => 1,
                            ]);

                            if($exam->exam_type == "Group"){
                                RewardPoint::create([
                                    'type'=>2,
                                    'user_id'=>$user->id,
                                    'exam_id'=>$exam->id,
                                    'reward_points'=>$questionSet->reward_point,
                                ]);
                                $exam->update(['reward_points'=>$questionSet->reward_point]);
                            }
                        }
                        else{
                            $exam->update([
                                'percentage' => $percentage,
                            ]);
                        }
                    }
                    else{

                        if(count($questionSet->questions))
                        {
                            foreach ($questionSet->questions as $key => $value) {

                                ExamQuestion::create([
                                    'exam_id' =>$exam->id,
                                    'question' =>$value->question,
                                    'option_a' =>$value->option_a,
                                    'option_b' =>$value->option_b,
                                    'option_c' =>$value->option_c,
                                    'option_d' =>$value->option_d,
                                    'correct_answer' =>$value->correct_answer,
                                    'answer' => null,
                                    'status' =>0,
                                ]); 
     
                            
                            } 
                        } 
                    } 

                    $percentage = round((($count*100)/$questionCount),2);
                    if($percentage >= $exam->pass_marks_percentage)
                    {
                        $exam->update([
                            'percentage' => $percentage,
                            'is_passed' => 1,
                        ]);

                        if($exam->exam_type == "Group"){
                                RewardPoint::create([
                                    'type'=>2,
                                    'user_id'=>$user->id,
                                    'exam_id'=>$exam->id,
                                    'reward_points'=>$questionSet->reward_point,
                                ]);
                                $exam->update(['reward_points'=>$questionSet->reward_point]);
                            }
                    }
                    else{
                            $exam->update([
                                'percentage' => $percentage,
                            ]);
                        }


                    return response()->json([
                            'status' => 'complete',
                            'data' => '',
                        ]);
                } 
                return response()->json([
                    'status' => 'complete',
                    'data' => '',
                ]);

                
                
    }

    public function getPreviousQuestion(Request $request)
    {
        $question = Question::where('question_set_id', $request->question_set_id)->offset($request->offset-1)->limit(1)->first();
        $previousAnswer = TempExamQuestion::where('id', $request->previousAnswerId)->first();
        $answer = TempExamQuestion::where('temp_exam_id', $previousAnswer->temp_exam_id)->offset($request->offset-2)->limit(1)->first();
        $previousAnswerId = $answer->id;
        if($question)
        {
           return response()->json([
                'status' => 'true',
                'data' => $question,
                'previousAnswer' => @$previousAnswer->answer,
                'previousAnswerId' => $previousAnswerId,
            ]); 
        }
    }

    public function answerSubmit(Request $request){

        /*try {*/

            $question = Question::where('question_set_id', $request->question_set_id)->offset($request->offset)->limit(1)->first();
            $previousAnswerId = null;
            $user = Auth::user();
            $questionSet = QuestionSet::where('active', 1)->where('id', $request->question_set_id)->first();

            /*if(isset($request->submit_answer))
            {*/
                $is_exam = TempExam::where([
                    'user_id' =>$user->id,
                    'question_set_id' =>$questionSet->id,
                    'subject_id' =>$questionSet->subject_id,
                    'chapter_id' =>$questionSet->chapter_id,
                ])->first();

                if(is_null($is_exam))
                {
                   $is_exam = TempExam::create([
                        'user_id' =>$user->id,
                        'question_set_id' =>$questionSet->id,
                        'subject_id' =>$questionSet->subject_id,
                        'chapter_id' =>$questionSet->chapter_id,
                        'pass_marks' =>$questionSet->pass_marks,
                    ]);
                }

                $getQuestion = Question::where('id', $request->question_id)->first();
                
                 $status = 0;
                if(isset($request->submit_answer))
                {
                    if($getQuestion->correct_answer == $request->submit_answer)
                    {
                        $status = 1;
                    }
                }
             
                $is_answer_submit = TempExamQuestion::where([
                    'temp_exam_id' =>$is_exam->id,
                    'question' =>$getQuestion->question,
                ])->first();

                if(is_null($is_answer_submit))
                {
                    $previousAnswer = TempExamQuestion::create([
                        'temp_exam_id' =>$is_exam->id,
                        'question' =>$getQuestion->question,
                        'option_a' =>$getQuestion->option_a,
                        'option_b' =>$getQuestion->option_b,
                        'option_c' =>$getQuestion->option_c,
                        'option_d' =>$getQuestion->option_d,
                        'correct_answer' =>$getQuestion->correct_answer,
                        'answer' =>@$request->submit_answer,
                        'status' =>$status,
                    ]); 

                 $previousAnswerId = $previousAnswer->id;
                    }
                    else{
                        $is_answer_submit->update([
                                'correct_answer' =>$getQuestion->correct_answer,
                                'answer' =>@$request->submit_answer,
                                'status' =>$status,
                            ]); 

                        $previousAnswerId = $is_answer_submit->id;
                    }


                
            /*}*/
            if($question)
            {
               return response()->json([
                    'status' => 'true',
                    'data' => $question,
                    'previousAnswerId' => $previousAnswerId,
                ]); 
            }
            else{
                $is_exam = TempExam::where([
                    'user_id' =>$user->id,
                    'question_set_id' =>$questionSet->id,
                    'subject_id' =>$questionSet->subject_id,
                    'chapter_id' =>$questionSet->chapter_id,
                ])->first();
                if($is_exam)
                {

                    $exam = Exam::create([
                        'user_id' =>$user->id,
                        'board_id' =>$user->board_id,
                        'board_class_id' =>$user->board_class_id,
                        'user_id' =>$user->id,
                        'question_set_id' =>$is_exam->question_set_id,
                        'subject_id' =>$is_exam->subject_id,
                        'chapter_id' =>$is_exam->chapter_id,
                        'pass_marks' =>$is_exam->pass_marks,
                        'pass_marks_percentage' =>$questionSet->pass_marks_percentage,
                    ]);
                    $questionData = TempExamQuestion::where(['temp_exam_id' =>$is_exam->id,])->get();

                    $count = 0;
                    $questionCount = 0;
                    if(count($questionData))
                    {
                        foreach ($questionData as $key => $value) {

                            $questionCount+=1;
                            if($value->status ==1)
                            {
                                $count+=1;
                            }
                            ExamQuestion::create([
                                'exam_id' =>$exam->id,
                                'question' =>$value->question,
                                'option_a' =>$value->option_a,
                                'option_b' =>$value->option_b,
                                'option_c' =>$value->option_c,
                                'option_d' =>$value->option_d,
                                'correct_answer' =>$value->correct_answer,
                                'answer' => $value->answer,
                                'status' =>$value->status,
                            ]); 
                        }
                    } 

                    $percentage = round((($count*100)/$questionCount),2);
                    if($percentage >= $exam->pass_marks_percentage)
                    {
                        $exam->update([
                            'percentage' => $percentage,
                            'is_passed' => 1,
                        ]);
                         $setting = Setting::first();
                        if($exam->exam_type == "Group"){
                                RewardPoint::create([
                                    'type'=>2,
                                    'user_id'=>$user->id,
                                    'exam_id'=>$exam->id,
                                    'reward_points'=>$questionSet->reward_point,
                                ]);
                                $exam->update(['reward_points'=>$questionSet->reward_point]);
                            }
                    }
                    else{
                            $exam->update([
                                'percentage' => $percentage,
                            ]);
                        }
                } 
                return response()->json([
                    'status' => 'complete',
                    'data' => '',
                ]);
            }
        /*} 
        catch (\Exception $e) 
        {
            return response()->json([
                'status' => 'warning',
                'message' => $e->getMessage(),
            ]);
            
        }*/
    }

    public function weeklyAnswerSubmit(Request $request){

        /*try {*/
            $previousAnswerId = null;
            $today = date('Y-m-d H:i:s');
            $user = Auth::user();
            $questionSet = QuestionSet::where('active', 1)->where('id', $request->question_set_id)->where('exam_type', $request->exam_type)->where('test_type', $request->test_type)->whereNull('chapter_id')->WhereRaw(
                'TIMESTAMP(`start_date`,`time`) <= ?', $today)->first();
            if(is_null($questionSet))
            {
                return response()->json([
                    'status' => 'not-start',
                    'message' => 'Exam not start currenly.Please check correct date time',
                ]);
            }
            $question = Question::where('question_set_id', $request->question_set_id)->offset($request->offset)->limit(1)->first();

            if(isset($request->question_id))
            {


                /*if(isset($request->submit_answer))
                {*/
                    $is_exam = TempExam::where([
                        'user_id' =>$user->id,
                        'question_set_id' =>$questionSet->id,
                        'exam_type' =>$questionSet->exam_type,
                        'test_type' =>$questionSet->test_type,
                    ])->first();

                    if(is_null($is_exam))
                    {
                       $is_exam = TempExam::create([
                            'user_id' =>$user->id,
                            'question_set_id' =>$questionSet->id,
                            'exam_type' =>$questionSet->exam_type,
                            'test_type' =>$questionSet->test_type,
                            'pass_marks' =>$questionSet->pass_marks,
                            'start_date' =>$questionSet->start_date,
                            'time' =>$questionSet->time,
                            'class_group_id' =>$user->class_group_id,
                        ]);
                    }

                    $getQuestion = Question::where('id', $request->question_id)->first();
                    
                     $status = 0;
                    if(isset($request->submit_answer))
                    {
                        if($getQuestion->correct_answer == $request->submit_answer)
                        {
                            $status = 1;
                        }
                    }
                 
                    $is_answer_submit = TempExamQuestion::where([
                        'temp_exam_id' =>$is_exam->id,
                        'question' =>$getQuestion->question,
                    ])->first();

                    if(is_null($is_answer_submit))
                    {
                        $previousAnswer = TempExamQuestion::create([
                            'temp_exam_id' =>$is_exam->id,
                            'question' =>$getQuestion->question,
                            'option_a' =>$getQuestion->option_a,
                            'option_b' =>$getQuestion->option_b,
                            'option_c' =>$getQuestion->option_c,
                            'option_d' =>$getQuestion->option_d,
                            'correct_answer' =>$getQuestion->correct_answer,
                            'answer' =>@$request->submit_answer,
                            'status' =>$status,
                        ]); 
                    $previousAnswerId = $previousAnswer->id;
                    }
                    else{
                        $is_answer_submit->update([
                                'correct_answer' =>$getQuestion->correct_answer,
                                'answer' =>@$request->submit_answer,
                                'status' =>$status,
                            ]); 

                        $previousAnswerId = $is_answer_submit->id;
                    }


                    
                /*}*/
            }
            if($question)
            {
               return response()->json([
                    'status' => 'true',
                    'data' => $question,
                    'previousAnswerId' => $previousAnswerId,
                ]); 
            }
            else{
                $is_exam = TempExam::where([
                    'user_id' =>$user->id,
                    'question_set_id' =>$questionSet->id,
                    'exam_type' =>$questionSet->exam_type,
                    'test_type' =>$questionSet->test_type,
                ])->first();
                if($is_exam)
                {

                    $exam = Exam::create([
                        'user_id' =>$user->id,
                        'board_id' =>$user->board_id,
                        'board_class_id' =>$user->board_class_id,
                        'question_set_id' =>$is_exam->question_set_id,
                        'exam_type' =>$questionSet->exam_type,
                        'test_type' =>$questionSet->test_type,
                        'pass_marks' =>$questionSet->pass_marks,
                        'start_date' =>$questionSet->start_date,
                        'pass_marks_percentage' =>$questionSet->pass_marks_percentage,
                        'time' =>$questionSet->time,
                        'class_group_id' =>$user->class_group_id,
                    ]);
                    $questionData = TempExamQuestion::where(['temp_exam_id' =>$is_exam->id,])->get();

                    $count = 0;
                    $questionCount = 0;
                    if(count($questionData))
                    {
                        foreach ($questionData as $key => $value) {

                            $questionCount+=1;
                            if($value->status ==1)
                            {
                                $count+=1;
                            }
                            ExamQuestion::create([
                                'exam_id' =>$exam->id,
                                'question' =>$value->question,
                                'option_a' =>$value->option_a,
                                'option_b' =>$value->option_b,
                                'option_c' =>$value->option_c,
                                'option_d' =>$value->option_d,
                                'correct_answer' =>$value->correct_answer,
                                'answer' => $value->answer,
                                'status' =>$value->status,
                            ]); 
                        }
                    } 

                    $percentage = round((($count*100)/$questionCount),2);
                    if($percentage >= $exam->pass_marks_percentage)
                    {
                        $exam->update([
                            'percentage' => $percentage,
                            'is_passed' => 1,
                        ]);
                         $setting = Setting::first();
                        if($exam->exam_type == "Group"){
                                RewardPoint::create([
                                    'type'=>2,
                                    'user_id'=>$user->id,
                                    'exam_id'=>$exam->id,
                                    'reward_points'=>$questionSet->reward_point,
                                ]);
                                $exam->update(['reward_points'=>$questionSet->reward_point]);
                            }
                    }
                    else{
                            $exam->update([
                                'percentage' => $percentage,
                            ]);
                        }
                } 

                $single_weekly_exam_passed = Exam::where('class_group_id', $user->class_group_id)->where('test_type', 'Weekly')->where('exam_type', 'Single')->where('is_passed', 1)->first();
                $group_weekly_exam_passed = Exam::where('class_group_id', $user->class_group_id)->where('test_type', 'Weekly')->where('exam_type', 'Group')->where('is_passed', 1)->first();
                $monthly_exam_passed = Exam::where('class_group_id', $user->class_group_id)->where('test_type', 'Monthly')->where('is_passed', 1)->first();

                if($single_weekly_exam_passed && $group_weekly_exam_passed && $monthly_exam_passed)
                {
                    if($user->group->slug == 'alfa')
                    {
                        $nextGroup = ClassGroup::where('board_class_id', $user->board_class_id)->where('slug', 'beata')->first();
                        if($nextGroup)
                        {
                            $user->update(['class_group_id' => $nextGroup->id]);
                        }
                    }
                    else if($user->group->slug == 'beata')
                    {
                        $nextGroup = ClassGroup::where('board_class_id', $user->board_class_id)->where('slug', 'theta')->first();
                        if($nextGroup)
                        {
                            $user->update(['class_group_id' => $nextGroup->id]);
                        }
                    }
                    else if($user->group->slug == 'theta')
                    {
                        $nextGroup = ClassGroup::where('board_class_id', $user->board_class_id)->where('slug', 'gama')->first();
                        if($nextGroup)
                        {
                            $user->update(['class_group_id' => $nextGroup->id]);
                        }
                    }
                }
                return response()->json([
                    'status' => 'complete',
                    'data' => '',
                ]);
            }
        /*} 
        catch (\Exception $e) 
        {
            return response()->json([
                'status' => 'warning',
                'message' => $e->getMessage(),
            ]);
            
        }*/
    }
    public function groupAnswerSubmit(Request $request){

        /*try {*/
            $previousAnswerId = null;
            $user = Auth::user();
            $group = ClassGroup::where('slug', $request->group_name)->where('board_class_id', $user->board_class_id)->first();

            if(is_null($group))
            {
                return redirect()->route('user.profile')->with('error', 'Something went wrong');
            }
            $today = date('Y-m-d H:i:s');
            $questionSet = QuestionSet::where('active', 1)->where('id', $request->question_set_id)->where('exam_type', $request->exam_type)->where('test_type', ucfirst($request->test_type))->whereNull('chapter_id')->WhereRaw(
                'TIMESTAMP(`start_date`,`time`) <= ?', $today)->first();
            if(is_null($questionSet))
            {
                return response()->json([
                    'status' => 'not-start',
                    'message' => 'Exam not start currenly.Please check correct date time',
                ]);
            }
            $question = Question::where('question_set_id', $request->question_set_id)->offset($request->offset)->limit(1)->first();

            if(isset($request->question_id))
            {


                /*if(isset($request->submit_answer))
                {*/
                    $is_exam = TempExam::where([
                        'user_id' =>$user->id,
                        'question_set_id' =>$questionSet->id,
                        'exam_type' =>$questionSet->exam_type,
                        'test_type' =>$questionSet->test_type,
                    ])->first();

                    if(is_null($is_exam))
                    {
                       $is_exam = TempExam::create([
                            'user_id' =>$user->id,
                            'question_set_id' =>$questionSet->id,
                            'exam_type' =>$questionSet->exam_type,
                            'test_type' =>$questionSet->test_type,
                            'pass_marks' =>$questionSet->pass_marks,
                            'start_date' =>$questionSet->start_date,
                            'time' =>$questionSet->time,
                            'class_group_id' =>$group->id,
                        ]);
                    }

                    $getQuestion = Question::where('id', $request->question_id)->first();
                    
                     $status = 0;
                    if(isset($request->submit_answer))
                    {
                        if($getQuestion->correct_answer == $request->submit_answer)
                        {
                            $status = 1;
                        }
                    }
                 
                    $is_answer_submit = TempExamQuestion::where([
                        'temp_exam_id' =>$is_exam->id,
                            'question' =>$getQuestion->question,
                    ])->first();

                    if(is_null($is_answer_submit))
                    {
                        $previousAnswer = TempExamQuestion::create([
                            'temp_exam_id' =>$is_exam->id,
                            'question' =>$getQuestion->question,
                            'option_a' =>$getQuestion->option_a,
                            'option_b' =>$getQuestion->option_b,
                            'option_c' =>$getQuestion->option_c,
                            'option_d' =>$getQuestion->option_d,
                            'correct_answer' =>$getQuestion->correct_answer,
                            'answer' =>@$request->submit_answer,
                            'status' =>$status,
                        ]); 

                        $previousAnswerId = $previousAnswer->id;
                    }
                    else{
                        $is_answer_submit->update([
                                'correct_answer' =>$getQuestion->correct_answer,
                                'answer' =>@$request->submit_answer,
                                'status' =>$status,
                            ]); 

                        $previousAnswerId = $is_answer_submit->id;
                    }
                    
                /*}*/
            }
            if($question)
            {
               return response()->json([
                    'status' => 'true',
                    'data' => $question,
                    'previousAnswerId' => $previousAnswerId,
                ]); 
            }
            else{
                
                $is_exam = TempExam::where([
                    'user_id' =>$user->id,
                    'question_set_id' =>$questionSet->id,
                    'exam_type' =>$questionSet->exam_type,
                    'test_type' =>$questionSet->test_type,
                ])->first();
                if($is_exam)
                {

                    $exam = Exam::create([
                        'user_id' =>$user->id,
                        'board_id' =>$user->board_id,
                        'board_class_id' =>$user->board_class_id,
                        'question_set_id' =>$is_exam->question_set_id,
                        'exam_type' =>$questionSet->exam_type,
                        'test_type' =>$questionSet->test_type,
                        'pass_marks' =>$questionSet->pass_marks,
                        'start_date' =>$questionSet->start_date,
                        'time' =>$questionSet->time,
                        'pass_marks_percentage' =>$questionSet->pass_marks_percentage,
                        'class_group_id' =>$group->id,
                    ]);
                    $questionData = TempExamQuestion::where(['temp_exam_id' =>$is_exam->id,])->get();

                    $count = 0;
                    $questionCount = 0;
                    if(count($questionData))
                    {
                        foreach ($questionData as $key => $value) {

                            $questionCount+=1;
                            if($value->status ==1)
                            {
                                $count+=1;
                            }
                            ExamQuestion::create([
                                'exam_id' =>$exam->id,
                                'question' =>$value->question,
                                'option_a' =>$value->option_a,
                                'option_b' =>$value->option_b,
                                'option_c' =>$value->option_c,
                                'option_d' =>$value->option_d,
                                'correct_answer' =>$value->correct_answer,
                                'answer' => $value->answer,
                                'status' =>$value->status,
                            ]); 
                        }
                    } 

                    $percentage = round((($count*100)/$questionCount),2);
                    if($percentage >= $exam->pass_marks_percentage)
                    {
                        $exam->update([
                            'percentage' => $percentage,
                            'is_passed' => 1,
                        ]);
                         $setting = Setting::first();
                        if($exam->exam_type == "Group"){
                                RewardPoint::create([
                                    'type'=>2,
                                    'user_id'=>$user->id,
                                    'exam_id'=>$exam->id,
                                    'reward_points'=>$questionSet->reward_point,
                                ]);
                                $exam->update(['reward_points'=>$questionSet->reward_point]);
                            }
                    }
                    else{
                            $exam->update([
                                'percentage' => $percentage,
                            ]);
                        }
                } 

                $single_weekly_exam_passed = Exam::where('class_group_id', $user->class_group_id)->where('test_type', 'Weekly')->where('exam_type', 'Single')->where('is_passed', 1)->first();
                $group_weekly_exam_passed = Exam::where('class_group_id', $user->class_group_id)->where('test_type', 'Weekly')->where('exam_type', 'Group')->where('is_passed', 1)->first();
                $monthly_exam_passed = Exam::where('class_group_id', $user->class_group_id)->where('test_type', 'Monthly')->where('is_passed', 1)->first();

                if($single_weekly_exam_passed && $group_weekly_exam_passed && $monthly_exam_passed)
                {
                    if($user->group->slug == 'alfa')
                    {
                        $nextGroup = ClassGroup::where('board_class_id', $user->board_class_id)->where('slug', 'beata')->first();
                        if($nextGroup)
                        {
                            $user->update(['class_group_id' => $nextGroup->id]);
                        }
                    }
                    else if($user->group->slug == 'beata')
                    {
                        $nextGroup = ClassGroup::where('board_class_id', $user->board_class_id)->where('slug', 'theta')->first();
                        if($nextGroup)
                        {
                            $user->update(['class_group_id' => $nextGroup->id]);
                        }
                    }
                    else if($user->group->slug == 'theta')
                    {
                        $nextGroup = ClassGroup::where('board_class_id', $user->board_class_id)->where('slug', 'gama')->first();
                        if($nextGroup)
                        {
                            $user->update(['class_group_id' => $nextGroup->id]);
                        }
                    }
                }
                return response()->json([
                    'status' => 'complete',
                    'data' => '',
                ]);
            }
        /*} 
        catch (\Exception $e) 
        {
            return response()->json([
                'status' => 'warning',
                'message' => $e->getMessage(),
            ]);
            
        }*/
    }
}
