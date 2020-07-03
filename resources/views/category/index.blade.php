@extends('layout.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <div class ="col-md-12">
                <div class="col-md-12">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                </div>
                <h2> Category -  Create New Category</h2>
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route'=>'category.store', 'method'=> 'POST'])!!}
                             <div class="form-group" style="width:80% ; margin:auto">
                                {{Form::label('cat_description', 'Enter Category Here:')}}
                                {{Form::text('cat_description', '', ['class' => 'form-control'])}}
                                <br>
                            </div>
                             <div class="form-group" style="width:80% ; margin:auto">
                                {{Form::submit('Create Category', ['class' => 'btn btn-primary '])}}
                            </div>
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection