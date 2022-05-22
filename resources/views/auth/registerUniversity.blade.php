@extends('layouts.app')

@section('content')
    <div class=" row mt-5 pt-5">
        <div class=" col-sm-8 offset-sm-2 jumbotron">
            <div class="text-center mb-3">
                <h2>大学を登録する</h2>
            </div>
            
            <div class="text-center">
                <form action="{{ route('signup.department') }}" method="POST">
                    @csrf
                    
                    <select name="university">
                        @foreach($universities as $university)
                            <option value="{{ $university->id }}">{{ $university->name }}</option>
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