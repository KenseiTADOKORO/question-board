@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-sm-10 offset-sm-1 bg-white">
            <div class="text-center mt-3">
                @if($user->image_path)
                    <img src="{{ $user->image_path }}" width="200" height="200" class="rounded-circle">
                @else
                    <img src="{{ asset('images/profile.jpeg') }}" width="150" height="150" class="rounded-circle">
                @endif
            </div>
            
            <div class="text-center mt-3">
                <form action="{{ route('users.image', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>プロフィール写真を変更：</label>
                    
                    <input type="file" name="image">
                    
                    <input type="submit" value="アップロード">
                </form>
            </div>
            
            <div class="mt-5 mb-5">
                {!! Form::open(['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                    <div class="form-group">
                        {!! Form::label('name', '名前：') !!}
                        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('introduction', '自己紹介：') !!}
                        {!! Form::textarea('introduction', $user->introduction, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group text-center">
                        {!! Form::submit('保存する', ['class' => 'btn btn-secondary']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            
            <div class="text-center mb-5">
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    {!! Form::submit('退会する', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection