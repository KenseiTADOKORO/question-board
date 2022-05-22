@extends('layouts.app')

@section('content')
    <div class="mt-5">
        {!! Form::open(['route' => ['questions.update', $question->id], 'method' => 'put']) !!}
            <div class="form-group">
                {!! Form::label('title', 'タイトル：') !!}
                {!! Form::text('title', $question->title, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('content', '質問内容：') !!}
                {!! Form::textarea('content', $question->content, ['class' => 'form-control', 'rows' => '5']) !!}
            </div>
            
            <div class="form-group">
                <div class="text-center">
                    {!! Form::submit('編集する', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
        
        {!! Form::open(['route' => ['questions.destroy', $question->id], 'method' => 'delete']) !!}
            <div class="form-group">
                <div class="text-center">
                    {!! Form::submit('削除する', ['class' => 'btn btn-danger']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection