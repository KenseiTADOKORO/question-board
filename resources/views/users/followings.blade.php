@extends('layouts.app')

@section('content')
    @include('users.show')
    
    <div class="mt-3">
        <table class="table table-bordered bg-white question-title">
            @foreach($followings as $following)
                <tr>
                    <th>
                        <a href="{{ route('users.question', ['id' => $following->id]) }}">
                            @if($following->image_path)
                                <img src="{{ $following->image_path }}" width="50" height="50" class="rounded-circle">
                            @else
                                <img src="{{ asset('images/profile.jpeg') }}" width="50" height="50" class="rounded-circle>
                            @endif
                            <h4 class="d-inline">{{ $following->name }}</h4>
                        </a>
                    </th>
                </tr>
            @endforeach
        </table>
        
        {{ $followings->links() }}
    </div>
@endsection