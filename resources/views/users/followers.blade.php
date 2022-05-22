@extends('layouts.app')

@section('content')
    @include('users.show')
    
    <div class="mt-3">
        <table class="table table-bordered bg-white question-title">
            @foreach($followers as $follower)
                <tr>
                    <th>
                        <a href="{{ route('users.question', ['id' => $follower->id]) }}">
                            @if($follower->image_path)
                                <img src="{{ $follower->image_path }}" width="50" height="50" class="rounded-circle">
                            @else
                                <img src="{{ asset('images/profile.jpeg') }}" width="50" height="50" class="rounded-circle>
                            @endif
                            <h4 class="d-inline">{{ $follower->name }}</h4>
                        </a>
                    </th>
                </tr>
            @endforeach
        </table>
        
        {{ $followers->links() }}
    </div>
@endsection