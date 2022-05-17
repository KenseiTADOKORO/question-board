@extends('layouts.app')

@section('content')
    <div class="mt-5">
        {!! Form::open(['route' => 'questions.store']) !!}
            <div class="form-group">
                {!! Form::label('title', 'タイトル：') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('content', '質問内容：') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '5']) !!}
            </div>
            
            <div class="form-group">
                <div class="text-center">
                    {!! Form::submit('投稿する', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection