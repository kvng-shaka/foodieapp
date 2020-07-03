@extends('layout.app')

@section('content')
    <!-- Hero Search Section Begin -->
    <div class="hero-search set-bg" data-setbg="{{asset('img/search-bg.jpg')}}">
        <div class="container">
            <div class="filter-table">
                <form action="#" class="filter-search">
                    <input type="text" placeholder="Search recipe">
                    <select id="category">
                        <option value="">Category</option>
                    </select>
                    <select id="tag">
                        <option value="">Tags</option>
                    </select>
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Hero Search Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="blog-pic">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <img style="width:100%" src="/storage/image_cover/{{$post->image_cover}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-text">
                        <div class="blog-title">
                            <h2>{{$post->title}}</h2>
                            <span>posted by {{$post->user->name}} on {{$post->created_at}}</span>
                            &nbsp;
                            
                        </div>
                        <div class="blog-desc">
                            <p>{{$post->body}}</p>
                            <br>
                            @if(!Auth::guest())
                                @if(Auth()->User()->id == $post->user_id)
                                    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary" style="float:left;">Edit</a>
                                    {!!Form::open(['action'=>['PostController@destroy', $post->id],'method'=>'POST', 'class'=>'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                    {!!Form::close() !!}
                                @endif
                            @endif
                        </div><br><br>
                        &nbsp;
                        
                        <form action="#" class="comment-form">
                            <h3>Leave a Comment</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Your name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Your email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Comment"></textarea>
                                </div>
                            </div>
                            <button type="submit">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Similar Recipe Section Begin -->
    <section class="similar-recipe spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="similar-item">
                        <a href="#"><img src="{{asset('img/cat-feature/small-7.jpg')}}" alt=""></a>
                        <div class="similar-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Italian Tiramisu with Coffe</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="similar-item">
                        <a href="#"><img src="{{asset('img/cat-feature/small-6.jpg')}}" alt=""></a>
                        <div class="similar-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Dry Cookies with Corn</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="similar-item">
                        <a href="#"><img src="{{asset('img/cat-feature/small-5.jpg')}}" alt=""></a>
                        <div class="similar-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Asparagus with Pork Loin and Vegetables</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="similar-item">
                        <a href="#"><img src="{{asset('img/cat-feature/small-4.jpg')}}" alt=""></a>
                        <div class="similar-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Smoked Salmon mini Sandwiches with Onion</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Similar Recipe Section End -->
@endsection