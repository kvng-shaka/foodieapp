@extends('layout.app')

@section('content')

    <?php
        $all_recs = App\category::where("cat_description","!=","")->get();
        $cats = array();

        foreach($all_recs as $rec){
            if ($rec['cat_description'] != "" && !in_array($rec['cat_description'],$cats)){
                $cats[$rec['cat_description']] = $rec['cat_description'];
            }
        }
    ?>
    @if(count($errors->all()) > 0 )
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
            </div>
        @endforeach
    @endif
    <br>
    <h1>Create Post</h1>

    {!! Form::open(['route' => 'posts.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group" style="width:80% ; margin:auto">
            {{Form::label('title', 'Title:')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' =>'Enter Title Here'])}}
            <br>
        </div>
        <div class="form-group" style="width:80% ; margin:auto">
            {{Form::label('body', 'Body:')}}
            {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' =>'Enter Body Here'])}}
        </div>
        <div class="form-group" style="width:80% ; margin:auto">
            {{Form::label('cat_description', 'Category:')}}
            {{Form::select('cat_description', [$cats], '', ['class' => 'form-control', 'placeholder' =>'Select Category'])}}
        </div>
        <br>
        <div class="form-group" style="width:80% ; margin:auto">
            {{Form::file('image_cover')}} 
        </div> 
        <br><br>
        <div class="form-group" style="width:80% ; margin:auto">
            {{Form::submit('Submit', ['class' => 'btn btn-primary '])}}
        </div>
    {!! Form::close() !!}
@endsection