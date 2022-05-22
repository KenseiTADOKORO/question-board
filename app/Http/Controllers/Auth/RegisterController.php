<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\University;
use App\Department;
use App\Course;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   protected function validator(array $data)
    {
        if(!empty($data['course'])) {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'department_id' => ['required'],
                'course' => ['required'],
            ]);
        }
        elseif(empty($data['course'])) {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'department_id' => ['required'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(!empty($data['course'])) {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'department_id' => $data['department_id'],
                'course_id' => $data['course'],
            ]);
        }
        elseif(empty($data['course'])) {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'department_id' => $data['department_id'],
            ]);
        }
    }
    
    public function showRegisterUniversityForm(Request $request) {
        $user_information = $request->all();
        
        $universities = University::all();
        
        return view('auth.registerUniversity', ['user_information' => $user_information, 'universities' => $universities]);
    }
    
    public function showRegisterDepartmentForm(Request $request) {
        $user_information = $request->all();
        
        $id = $user_information['university'];
        
        $departments = Department::where('university_id', $id)->get();
        
        return view('auth.registerDepartment', ['user_information' => $user_information, 'departments' => $departments]);
    }
    
    public function showRegisterCourseForm(Request $request) {
        $user_information = $request->all();
        
        $id = $user_information['department'];
        
        $courses = Course::where('department_id', $id)->get();
        
        return view('auth.registerCourse', ['user_information' => $user_information, 'courses' => $courses]);
    }
}
