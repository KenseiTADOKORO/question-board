@extends('layouts.app')

@section('content')
    <div class="row mt-5 pt-5">
        <div class="col-sm-8 offset-sm-2 jumbotron">
            <div class="text-center mb-3">
                <h2>学科を登録する</h2>
            </div>
            
            <div class="text-center">
                <form action="{{ route('signup.post') }}" method="POST">
                    @csrf
                    
                    <select name="course">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                    
                    <input type="hidden" name="name" value="{{ $user_information['name'] }}">
                    <input type="hidden" name="email" value="{{ $user_information['email'] }}">
                    <input type="hidden" name="password" value="{{ $user_information['password'] }}">
                    <input type="hidden" name="password_confirmation" value="{{ $user_information['password_confirmation'] }}">
                    <input type="hidden" name="department_id" value="{{ $user_information['department'] }}">
                    
                    <input type="submit" value="登録する">
                </form>
            </div>
        </div>
    </div>
@endsection