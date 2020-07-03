@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="/posts/create" class="btn btn-primary">Create New Post</a>
                    <br>
                    <br>
                   <h4>welcome <strong><i>{{Auth()->User()->name}}</i></strong></h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                
                    <h3>Your Blog Posts:</h3>
                    @if(count($myposts)> 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Posts</th>
                                <th></th>
                                <th></th>
                            </tr>
                        
                            @foreach($myposts as $post)
                                    <tr>
                                        <td><h3>{{$post->title}}</h3><em>written by {{Auth()->User()->name}}</em><p>on</p><em>{{$post->created_at}}</em></td>
                                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                        <td>
                                             {!!Form::open(['action'=>['PostController@destroy', $post->id],'method'=>'POST', 'class'=>'pull-right'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                            {!!Form::close() !!}
                                        </td>
                                    </tr>
                            @endforeach 
                                            
                        </table>
                    @else
                        &nbsp;
                        <h3><strong>Oops! You have no posts</strong></h3>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
