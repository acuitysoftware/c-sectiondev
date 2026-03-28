<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chapter;
use App\Models\QuestionSet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chapter_id)
    {
        $chapter = Chapter::find($chapter_id);
        if($chapter)
        {
            return view('admin.question-set.question-set-list',['chapter'=>$chapter]);
        }
        return redirect()->route('chapter.index')->with('error', 'Data not found');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($chapter_id)
    {
        $chapter = Chapter::find($chapter_id);
        if($chapter)
        {
        return view('admin.question-set.question-set-create-edit',['chapter'=>$chapter , 'question_set'=>null]);
        }
        return redirect()->route('chapter.index')->with('error', 'Data not found');
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
    public function edit($chapter_id, $id)
    {
        $chapter = Chapter::find($chapter_id);
        $question_set = QuestionSet::where('id',$id)->where('chapter_id', $chapter_id)->first();
        if($question_set)
        {
            return view('admin.question-set.question-set-create-edit',['chapter'=>$chapter , 'question_set'=>$question_set]);
        }
        return redirect()->route('chapter.index')->with('error', 'Data not found');
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
