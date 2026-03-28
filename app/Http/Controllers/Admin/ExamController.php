<?php

namespace App\Http\Controllers\Admin;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return view('admin.exam.exam-list');
    }
    public function show($id)
    {
    	$exam = Exam::find($id);
    	if($exam){
    		$data['exam'] = $exam;
        	return view('admin.exam.exam-view',$data);
    	}
        else
        	return redirect()->route('exams.index');
    }
}
