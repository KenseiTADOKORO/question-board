@extends('layouts.app')

@section('content')
    <div class="mt-3">
        <div class="text-center mb-3">
            <h2>会員登録</h2>
        </div>
        
        {!! Form::open(['route' => 'signup.post']) !!}
            <div class="form-group">
                {!! Form::label('name', '名前：') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('email', 'メールアドレス：') !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('password', 'パスワード：') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('password_confirmation', 'パスワード（確認）：') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
        {!! Form::close() !!}
        
        <p>ログインは、{!! link_to_route('login', 'こちら') !!}</p>
    </div>
@endsection