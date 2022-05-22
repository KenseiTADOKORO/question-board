@extends('layouts.app')

@section('content')
    @include('users.show')
    
    <div class="mt-3">
        <table class="table table-bordered bg-white question-title">
            @foreach($answers as $answer)
                <tr>
                    <th><a href="{{ route('answers.show', ['answer' => $answer->id]) }}" class="text-truncate" style="max-width: 1108px;">{{ $answer->content }}<br>質問：{{ $answer->question->title }}</a></th>
                </tr>
            @endforeach
        </table>
        
        {{ $answers->links() }}
    </div>
@endsection