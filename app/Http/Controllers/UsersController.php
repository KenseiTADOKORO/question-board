<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Course;
use App\Department;
use App\University;
use Storage;

class UsersController extends Controller
{
    public function showQuestionsList($id) {
        $user = User::findOrFail($id);
        $user->loadRelationshipCounts();
        
        $questions = $user->questions()->orderBy('created_at', 'desc')->paginate(10);
        
        if($user->course_id === null) {
            $department = Department::findOrFail($user->department_id);
            $university = University::findOrFail($department->university_id);
            
            $data = ['user' => $user, 'questions' => $questions, 'department' => $department, 'university' => $university];
        }
        elseif($user->course_id !== null) {
            $course = Course::findOrFail($user->course_id);
            $department = Department::findOrFail($course->department_id);
            $university = University::findOrFail($department->university_id);
            
            $data = ['user' => $user, 'questions' => $questions, 'course' => $course, 'department' => $department, 'university' => $university];
        }
        
        return view('users.question', $data);
    }
    
    public function showAnswersList($id) {
        $user = User::findOrFail($id);
        $user->loadRelationshipCounts();
        
        $answers = $user->answers()->orderBy('created_at', 'desc')->paginate(10);
        
        if($user->course_id === null) {
            $department = Department::findOrFail($user->department_id);
            $university = University::findOrFail($department->university_id);
            
            $data = ['user' => $user, 'answers' => $answers, 'department' => $department, 'university' => $university];
        }
        elseif($user->course_id !== null) {
            $course = Course::findOrFail($user->course_id);
            $department = Department::findOrFail($course->department_id);
            $university = University::findOrFail($department->university_id);
            
            $data = ['user' => $user, 'answers' => $answers, 'course' => $course, 'department' => $department, 'university' => $university];
        }
        
        return view('users.answer', $data);
    }
    
    public function followings($id) {
        $user = User::findOrFail($id);
        $user->loadRelationshipCounts();
        
        $followings = $user->followings()->orderBy('created_at', 'desc')->paginate(10);
        
        if($user->course_id === null) {
            $department = Department::findOrFail($user->department_id);
            $university = University::findOrFail($department->university_id);
            
            $data = ['user' => $user, 'followings' => $followings, 'department' => $department, 'university' => $university];
        }
        elseif($user->course_id !== null) {
            $course = Course::findOrFail($user->course_id);
            $department = Department::findOrFail($course->department_id);
            $university = University::findOrFail($department->university_id);
            
            $data = ['user' => $user, 'followings' => $followings, 'course' => $course, 'department' => $department, 'university' => $university];
        }
        
        return view('users.followings', $data);
    }
    
    public function followers($id) {
        $user = User::findOrFail($id);
        $user->loadRelationshipCounts();
        
        $followers = $user->followers()->orderBy('created_at', 'desc')->paginate(10);
        
        if($user->course_id === null) {
            $department = Department::findOrFail($user->department_id);
            $university = University::findOrFail($department->university_id);
            
            $data = ['user' => $user, 'followers' => $followers, 'department' => $department, 'university' => $university];
        }
        elseif($user->course_id !== null) {
            $course = Course::findOrFail($user->course_id);
            $department = Department::findOrFail($course->department_id);
            $university = University::findOrFail($department->university_id);
            
            $data = ['user' => $user, 'followers' => $followers, 'course' => $course, 'department' => $department, 'university' => $university];
        }
        
        return view('users.followers', $data);
    }
    
    public function edit($id) {
        $user = User::findOrFail($id);
        
        if(\Auth::id() === $user->id) {
            return view('users.edit', ['user' => $user]);
        }
    }
    
    public function image(Request $request, $id) {
        $request->validate(['image' => 'file|max:10240']);
        
        $user = User::findOrFail($id);
        
        $image = $request->file('image');
        
        $path = Storage::disk('s3')->putFile('my_image', $image, 'public');
        
        if(\Auth::id() === $user->id) {
            $user->image_path = Storage::disk('s3')->url($path);
            $user->save();
        }
        
        return redirect()->route('users.edit', ['id' => $user->id]);
    }
    
    public function update(Request $request, $id) {
        $request->validate(['name' => 'required|string|max:255', 'introduction' => 'string|max:200|nullable']);
        
        $user = User::findOrFail($id);
        
        if(\Auth::id() === $user->id) {
            $user->name = $request->name;
            $user->introduction = $request->introduction;
            $user->save();
        }
        
        return redirect()->route('users.question', ['id' => $user->id]);
    }
    
    public function destroy($id) {
        $user = User::findOrFail($id);
        
        if(\Auth::id() === $user->id) {
            $user->delete();
        }
        
        return redirect('/');
    }
}
