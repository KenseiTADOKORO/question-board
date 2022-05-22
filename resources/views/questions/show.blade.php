@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-sm-7">
            <div class="pb-5">
                <div>
                    <h2>質問</h2>
                </div>
                
                <div class="bg-white pb-3 border-top">
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
                    
                    <div class="ml-5 mr-5 mb-5">
                        <h5 class="pt-3 pb-3">{!! nl2br(e($question->content)) !!}</h5>
                    </div>
                    
                    <div>
                        <p class="text-right mb-0 mr-1" style="color: gray;"><i class="fas fa-clock"></i> {{ $question->created_at }}</p>
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
                                        {!! Form::submit('回答する', ['class' => 'btn btn-warning']) !!}
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
                            <div class="row">
                                <div class="mt-2 ml-4">
                                    @if($answer->user->image_path)
                                        <img src="{{ $answer->user->image_path }}" width="30" height="30" class="rounded-circle">
                                    @else
                                        <img src="{{ asset('images/profile.jpeg') }}" width="30" height="30" class="rounded-circle">
                                    @endif
                                </div>
                                
                                <div class="mt-2 ml-2">
                                    <p>{!! link_to_route('users.question', $answer->user->name, ['id' => $answer->user->id]) !!}</p>
                                </div>
                            </div>
                            
                            <div class="ml-5 mr-5 mb-4">
                                <h5>{!! nl2br(e($answer->content)) !!}</h5>
                            </div>
                            
                            <div>
                                <p class="text-right mb-0 mr-1" style="color: gray;"><i class="fas fa-clock"></i> {{ $answer->created_at }}</p>
                            </div>
                        </div>
                    @endforeach
                    
                    {{ $answers->links() }}
                </div>
            @endif
        </div>
        
        <div class="col-sm-4 offset-sm-1 bg-white" style="height: 500px;">
            @include('users.profile')
        </div>
    </div>
@endsection