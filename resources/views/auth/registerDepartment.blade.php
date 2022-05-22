@extends('layouts.app')

@section('content')
    <div class="row mt-5 pt-5">
        <div class="col-sm-8 offset-sm-2 jumbotron">
            <div class="text-center mb-3">
                <h2>学部を登録する</h2>
            </div>
            
            <div class="text-center">
                <form action="{{ route('signup.course') }}" method="POST">
                    @csrf
                    
                    <select name="department">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    
                    <input type="hidden" name="name" value="{{ $user_information['name'] }}">
                    <input type="hidden" name="email" value="{{ $user_information['email'] }}">
                    <input type="hidden" name="password" value="{{ $user_information['password'] }}">
                    <input type="hidden" name="password_confirmation" value="{{ $user_information['password_confirmation'] }}">
                    
                    <input type="submit" value="次へ">
                </form>
            </div>
        </div>
    </div>
@endsection