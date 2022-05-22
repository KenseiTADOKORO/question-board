@extends('layouts.app')

@section('content')
    @include('users.show')
    
    <div class="mt-3">
        <table class="table table-bordered bg-white question-title">
            @foreach($questions as $question)
                <tr>
                    <th><a href="{{ route('questions.show', ['question' => $question->id]) }}" class="text-truncate" style="max-width: 1108px;">{{ $question->title }}</a></th>
                </tr>
            @endforeach
        </table>
        
        {{ $questions->links() }}
    </div>
@endsection