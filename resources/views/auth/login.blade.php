@extends('layouts.app')

@section('content')
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
@endsection