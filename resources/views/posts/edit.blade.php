@extends('layout.app')

@section('content')
    <h1>Edit Post</h1>

    {!! Form::open(['route' => ['posts.update',$post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group" style="width:80% ; margin:auto">
            {{Form::label('title', 'Title:')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' =>'Enter Title Here'])}}
            <br>
        </div>
        <div class="form-group" style="width:80% ; margin:auto">
            {{Form::label('body', 'Body:')}}
            {{Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' =>'Enter Body Here'])}}
        </div>
        <br>
        <div class="form-group" style="width:80% ; margin:auto">
            {{Form::file('image_cover')}} 
        </div> 
        <br><br>
        <div class="form-group" style="width:80% ; margin:auto">
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary '])}}
        </div>
    {!! Form::close() !!}
@endsection