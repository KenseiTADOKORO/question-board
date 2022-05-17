<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        
        if(\Auth::check()) {
            $profile_user = \Auth::user();
            
            $profile_user->loadRelationshipCounts();
            
            $questions = Question::orderBy('created_at', 'desc')->get();
            
            $data = ['profile_user' => $profile_user, 'questions' => $questions];
        }
        
        return view('welcome', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.post_questions');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'content' => 'required']);
        
        $request->user()->questions()->create([
            'title' => $request->title,
            'content' => $request->content
        ]);
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);
        
        $user = $question->user;
        
        $profile_user = \Auth::user();
        
        $answers = $question->answers;
        
        return view('questions.show', ['question' => $question, 'user' => $user, 'profile_user' => $profile_user, 'answers' => $answers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        
        if(\Auth::id() === $question->user_id) {
            return view('questions.edit', ['question' => $question]);
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
        $request->validate(['title' => 'required', 'content' => 'required']);
        
        $question = Question::findOrFail($id);
        
        if(\Auth::id() === $question->user_id) {
            $question->title = $request->title;
            $question->content = $request->content;
            $question->save();
        }
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        
        if(\Auth::id() === $question->user_id) {
            $question->delete();
        }
        
        return redirect('/');
    }
}
