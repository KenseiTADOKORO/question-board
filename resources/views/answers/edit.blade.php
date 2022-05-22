@extends('layouts.app')

@section('content')
    <div class="bg-white mt-5">
        <div class="row">
            <div class="mt-2 ml-4">
                @if($user->image_path)
                    <img src="{{ $user->image_path }}" width="30" height="30" class="rounded-circle">
                @else
                    <img src="{{ asset('images/profile.jpeg') }}" width="30" height="30" class="rounded-circle">
                @endif
            </div>
            
            <div class="mt-2 ml-2">
                <p>{!! link_to_route('users.question', $user->name, ['id' => $user->id]) !!}</p>
            </div>
        </div>
        
        <div class="ml-5 mr-5">
            <h2 class="pb-3">{{ $question->title }}</h2>
        </div>
        
        <div class="ml-5 mr-5">
            <h5 class="pt-3 pb-3">{{ $question->content }}</h5>
        </div>
        
        <div>
            <p class="text-right mb-0 mr-1" style="color: gray;"><i class="fas fa-clock"></i> {{ $question->created_at }}</p>
        </div>
    </div>

    <div class="mt-5">
        {!! Form::open(['route' => ['answers.update', $answer->id], 'method' => 'put']) !!}
            <div class="form-group">
                {!! Form::label('content', '回答内容：') !!}
                {!! Form::textarea('content', $answer->content, ['class' => 'form-control', 'rows' => '5']) !!}
            </div>
            
            <div class="form-group">
                <div class="text-center">
                    {!! Form::submit('編集する', ['class' => 'btn btn-warning']) !!}
                </div>
            </div>
        {!! Form::close() !!}
        
        {!! Form::open(['route' => ['answers.destroy', $answer->id], 'method' => 'delete']) !!}
            <div class="form-group">
                <div class="text-center">
                    {!! Form::submit('削除する', ['class' => 'btn btn-danger']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection