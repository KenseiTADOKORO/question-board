@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <h1>ログイン済み</h1>
    @else
        <div class="center jumbotron mt-5">
            <div class="text-center">
                <h1>QuestionBoard</h1>
                
                {!! link_to_route('signup.get', '会員登録', [], ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection