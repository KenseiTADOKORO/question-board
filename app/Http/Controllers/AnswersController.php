<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Answer;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate(['content' => 'required']);
        
        $answer = new Answer();
        $answer->content = $request->content;
        $answer->user_id = $request->user()->id;
        $answer->question_id = $id;
        $answer->save();
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $my_answer = Answer::findOrFail($id);
        $my_user = $my_answer->user;
        
        $question = $my_answer->question;
        $question_user = $question->user;
        
        $answers = $question->answers()->where('user_id', '!=', $my_user->id)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('answers.show', [
            'question' => $question,
            'question_user' => $question_user,
            'my_answer' => $my_answer,
            'my_user' => $my_user,
            'answers' => $answers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $answer = Answer::findOrFail($id);
        
        $question = $answer->question;
        
        $user = $question->user;
        
        if(\Auth::id() === $answer->user_id) {
            return view('answers.edit', ['answer' => $answer, 'question' => $question, 'user' => $user]);
        }
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
        $request->validate(['content' => 'required']);
        
        $answer = Answer::findOrFail($id);
        
        if(\Auth::id() === $answer->user_id) {
            $answer->content = $request->content;
            $answer->save();
        }
        
        return redirect(route('answers.show', ['answer' => $answer->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        
        $answer_id = $answer->id;
        
        if(\Auth::id() === $answer->user_id) {
            $answer->delete();
        }
        
        return redirect('/');
    }
}
