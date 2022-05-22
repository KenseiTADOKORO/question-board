<div class="row mt-5 pt-3 pb-3 bg-white">
    <div class="col-sm-4 text-center">
        <div>
            @if($user->image_path)
                <img src="{{ $user->image_path }}" width="150" height="150" class="rounded-circle">
            @else
                <img src="{{ asset('images/profile.jpeg') }}" width="150" height="150" class="rounded-circle">
            @endif
        </div>
        
        <h3>{{ $user->name }}</h3>
        @if(Auth::id() == $user->id)
            <div>
                {!! link_to_route('users.edit', 'プロフィールを編集', ['id' => $user->id], ['class' => 'btn btn-secondary']) !!}
            </div>
        @else
            @if(Auth::user()->is_following($user->id))
                <div>
                    {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
                        {!! Form::submit('フォロー解除', ['class' => 'btn btn-light']) !!}
                    {!! Form::close() !!}
                </div>
            @else
                <div>
                    {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
                        {!! Form::submit('フォロー', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            @endif
        @endif
    </div>
    
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-3 text-center">
                <h5><a href="{{ route('users.question', ['id' => $user->id]) }}">{{ $user->questions_count }}<br>質問</a></h5>
            </div>
                    
            <div class="col-sm-3 text-center">
                <h5><a href="{{ route('users.answer', ['id' => $user->id]) }}">{{ $user->answers_count }}<br>回答</a></h5>
            </div>
                    
            <div class="col-sm-3 text-center">
                <h5><a href="{{ route('users.followings', ['id' => $user->id]) }}">{{ $user->followings_count }}<br>フォロー</a></h5>
            </div>
                    
            <div class="col-sm-3 text-center">
                <h5><a href="{{ route('users.followers', ['id' => $user->id]) }}">{{ $user->followers_count }}<br>フォロワー</a></h5>
            </div>
        </div>
        
        <div class="mt-3 ml-5">
            @if($user->course_id == null)
                <h6>{{ $university->name }}・{{ $department->name }}</h6>
            @else
                <h6>{{ $university->name }}・{{ $department->name }}・{{ $course->name }}学科</h6>
            @endif
        </div>
        
        <div class="mt-3 ml-5">
            <h6>{!! nl2br(e($user->introduction)) !!}</h6>
        </div>
    </div>
</div>

