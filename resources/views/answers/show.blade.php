@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-sm-8 offset-sm-2">
            <div class="pb-5">
                <div>
                    <h2>質問</h2>
                </div>
                
                <div class="bg-white border-top">
                    <div class="row">
                        <div class="mt-2 ml-4">
                            @if($question_user->image_path)
                                <img src="{{ $question_user->image_path }}" width="30" height="30" class="rounded-circle">
                            @else
                                <img src="{{ asset('images/profile.jpeg') }}" width="30" height="30" class="rounded-circle">
                            @endif
                        </div>
                        
                        <div class="mt-2 ml-2">
                            <p>{!! link_to_route('users.question', $question_user->name, ['id' => $question_user->id]) !!}</p>
                        </div>
                    </div>
                    
                    <div class="ml-5 mr-5">
                        <h2 class="pb-3">{{ $question->title }}</h2>
                    </div>
                    
                    <div class="ml-5 mr-5 mb-5">
                        <h5 class="pt-3 pb-3">{{ $question->content }}</h5>
                    </div>
                    
                    <div>
                        <p class="text-right mb-0 mr-1" style="color: gray;"><i class="fas fa-clock"></i> {{ $question->created_at }}</p>
                    </div>
                </div>
                
                <div class="mt-5">
                    <h2>あなたの回答</h2>
                </div>
                
                <div class="bg-white border-top">
                    <div class="row">
                        <div class="mt-2 ml-4">
                            @if($my_user->image_path)
                                <img src="{{ $my_user->image_path }}" width="30" height="30" class="rounded-circle">
                            @else
                                <img src="{{ asset('images/profile.jpeg') }}" width="30" height="30" class="rounded-circle">
                            @endif
                        </div>
                        
                        <div class="mt-2 ml-2">
                            <p>{!! link_to_route('users.question', $my_user->name, ['id' => $my_user->id]) !!}</p>
                        </div>
                    </div>
                    
                    <div class="ml-5 mr-5">
                        <h5>{{ $my_answer->content }}</h5>
                    </div>
                    
                    
                    <div class="ml-5 mt-4">
                        {!! link_to_route('answers.edit', '編集する', ['answer' => $my_answer->id], ['class' => 'btn btn-secondary']) !!}
                    </div>
                    
                    <div>
                        <p class="text-right mb-0 mr-1" style="color: gray;"><i class="fas fa-clock"></i> {{ $my_answer->created_at }}</p>
                    </div>
                </div>
                
                @if(count($answers) > 0)
                    <div class="mt-5">
                        <h2>他のユーザの回答</h2>
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
                                <h5>{{ $answer->content }}</h5>
                            </div>
                            
                            <div>
                                <p class="text-right mb-0 mr-1" style="color: gray;"><i class="fas fa-clock"></i> {{ $answer->created_at }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
                
                {{ $answers->links() }}
            </div>
        </div>
    </div>
@endsection