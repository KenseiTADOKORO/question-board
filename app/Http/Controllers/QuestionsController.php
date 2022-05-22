<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\Course;
use App\Department;
use App\University;
use App\User;

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
            
            if($profile_user->course_id === null) {
                $department = Department::findOrFail($profile_user->department_id);
                $university = University::findOrFail($department->university_id);
                
                $questions = Question::orderBy('created_at', 'desc')->where('university_id', $university->id)->paginate(20);
                
                $data = ['profile_user' => $profile_user, 'questions' => $questions, 'department' => $department, 'university' => $university];
            }
            elseif($profile_user->course_id !== null) {
                $course = Course::findOrFail($profile_user->course_id);
                $department = Department::findOrFail($course->department_id);
                $university = University::findOrFail($department->university_id);
                
                $questions = Question::orderBy('created_at', 'desc')->where('university_id', $university->id)->paginate(20);
                
                $data = ['profile_user' => $profile_user, 'questions' => $questions, 'course' => $course, 'department' => $department, 'university' => $university];
            }
            
        }
        
        return view('welcome', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::findOrFail($id);
        
        return view('questions.post_questions', ['user' => $user]);
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
            'content' => $request->content,
            'course_id' => $request->course_id,
            'department_id' => $request->department_id,
            'university_id' => $request->university_id,
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
        $profile_user->loadRelationshipCounts();
        
        $answers = $question->answers()->orderBy('created_at', 'desc')->paginate(10);
        
        if($profile_user->course_id === null) {
            $department = Department::findOrFail($profile_user->department_id);
            $university = University::findOrFail($department->university_id);
            
            $data = ['user' => $user, 'profile_user' => $profile_user, 'question' => $question, 'answers' => $answers, 'department' => $department, 'university' => $university];
        }
        elseif($profile_user->course_id !== null) {
            $course = Course::findOrFail($profile_user->course_id);
            $department = Department::findOrFail($course->department_id);
            $university = University::findOrFail($department->university_id);
            
            $data = ['user' => $user, 'profile_user' => $profile_user, 'question' => $question, 'answers' => $answers, 'course' => $course, 'department' => $department, 'university' => $university];
        }
        
        return view('questions.show', $data);
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
