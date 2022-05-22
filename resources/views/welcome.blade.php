@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="row mt-5">
            <div class="col-sm-7">
                <div class="row">
                    <div class="ml-4">
                        <h2>質問一覧</h2>
                    </div>
                    
                    <div class="ml-3">
                        {!! link_to_route('questions.create', '質問する', ['id' => $profile_user->id], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                
                <table class="table table-bordered bg-white question-title">
                    @foreach($questions as $question)
                        <tr>
                            <th><a href="{{ route('questions.show', ['question' => $question->id]) }}" class="text-truncate" style="max-width: 633px;">{{ $question->title }}</a></th>
                        </tr>
                    @endforeach
                </table>
                
                {{ $questions->links() }}
            </div>
            
            <div class="col-sm-4 offset-sm-1 bg-white" style="height: 500px;">
                @include('users.profile')
            </div>
        </div>
    @else
    <div class="mt-3">
        <div class="text-center mb-5">
            <h2>ログイン</h2>
        </div>
        
        {!! Form::open(['route' => 'login.post']) !!}
            <div class="form-group">
                {!! Form::label('email', 'メールアドレス：') !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('password', 'パスワード：') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
            </div>
        {!! Form::close() !!}
        
        <p>会員登録がお済みでない方は、{!! link_to_route('signup.get', 'こちら') !!}</p>
    </div>
    @endif
@endsection