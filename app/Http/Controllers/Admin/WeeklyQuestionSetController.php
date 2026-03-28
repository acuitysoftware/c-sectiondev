<?php

namespace App\Http\Controllers\Admin;

use App\Models\BoardClass;
use App\Models\QuestionSet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeeklyQuestionSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($board_class_id)
    {
        $board_class = BoardClass::find($board_class_id);
        if($board_class)
        {
            return view('admin.weekly-question-set.weekly-question-set-list',['board_class'=>$board_class]);
        }
        return redirect()->route('board-class.index')->with('error', 'Data not found');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($board_class_id)
    {
        $board_class = BoardClass::find($board_class_id);
        if($board_class)
        {
        return view('admin.weekly-question-set.weekly-question-set-create-edit',['board_class'=>$board_class , 'question_set'=>null]);
        }
        return redirect()->route('board-class.index')->with('error', 'Data not found');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($board_class_id, $id)
    {
        $board_class = BoardClass::find($board_class_id);
        $question_set = QuestionSet::where('id',$id)->where('board_class_id', $board_class_id)->first();
        if($question_set)
        {
            return view('admin.weekly-question-set.weekly-question-set-create-edit',['board_class'=>$board_class , 'question_set'=>$question_set]);
        }
        return redirect()->route('board-class.index')->with('error', 'Data not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
