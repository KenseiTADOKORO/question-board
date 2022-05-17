@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-sm-7">
            <div class="pb-5">
                <div>
                    <h2>質問</h2>
                </div>
                
                <div class="bg-white question-detail pb-3">
                    <p>{!! link_to_route('users.get', $user->name, ['id' => $user->id]) !!}</p>
                    
                    <div class="ml-5 mr-5">
                        <h2 class="pb-3">{{ $question->title }}</h2>
                    </div>
                    
                    <div class="ml-5 mr-5">
                        <h5 class="pt-3 pb-3">{{ $question->content }}</h5>
                    </div>
                    
                    <div class="answer-form-border mb-3"></div>
                    
                    <div class="row">
                        @if(Auth::id() == $user->id)
                            <div class="mx-auto">
                                {!! link_to_route('questions.edit', '編集する', ['question' => $question->id], ['class' => 'btn btn-secondary']) !!}
                            </div>
                        @else
                            <div class="col-sm-10 offset-sm-1">
                                {!! Form::open(['route' => ['answers.store', $question->id]]) !!}
                                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '5']) !!}
                                    
                                    <div class="text-center mt-2">
                                        {!! Form::submit('投稿する', ['class' => 'btn btn-warning']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            @if(count($answers) > 0)
                <div class="mt-5 mb-5">
                    <div>
                        <h2>回答</h2>
                    </div>
                    
                    @foreach($answers as $answer)
                        <div class="bg-white border-top">
                            <p><a href="#">{{ $answer->user->name }}</a></p>
                            
                            <div class="ml-5 mr-5">
                                <h5>{{ $answer->content }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        <div class="col-sm-4 offset-sm-1 bg-white">
            @include('users.profile')
        </div>
    </div>
@endsection