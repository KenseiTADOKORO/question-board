<div class="bg-white h-50">
    <div class="text-center mt-3">
        @if($profile_user->image_path)
            <img src="{{ $profile_user->image_path }}" width="150" height="150" class="rounded-circle">
        @else
            <img src="{{ asset('images/profile.jpeg') }}" width="150" height="150" class="rounded-circle">
        @endif
    </div>
    
    <div class="text-center mt-2">
        <h2>{!! link_to_route('users.question', $profile_user->name, ['id' => $profile_user->id]) !!}</h2>
    </div>
    
    <div class="text-center">
        @if($profile_user->course_id == null)
            <h6>{{ $university->name }}・{{ $department->name }}</h6>
        @else
            <h6>{{ $university->name }}・{{ $department->name }}・{{ $course->name }}学科</h6>
        @endif
    </div>
    
    <div class="row mt-5">
        <div class="col-sm-6 text-center">
            <h5><a href="{{ route('users.question', ['id' => $profile_user->id]) }}">{{ $profile_user->questions_count }}<br>質問</a></h5>
        </div>
        
        <div class="col-sm-6 text-center">
            <h5><a href="{{ route('users.answer', ['id' => $profile_user->id]) }}">{{ $profile_user->answers_count }}<br>回答</a></h5>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-sm-6 text-center">
            <h5><a href="{{ route('users.followings', ['id' => $profile_user->id]) }}">{{ $profile_user->followings_count }}<br>フォロー</a></h5>
        </div>
                
        <div class="col-sm-6 text-center">
            <h5><a href="{{ route('users.followers', ['id' => $profile_user->id]) }}">{{ $profile_user->followers_count }}<br>フォロワー</a></h5>
        </div>
    </div>
</div>