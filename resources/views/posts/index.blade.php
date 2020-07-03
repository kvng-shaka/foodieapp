@extends('layout.app');

@section('content')

    <?php 
    $cat_desc = "";
    if(isset($cat_id) && ($cat_id != "")){
        $cat_item = App\Category::find($cat_description);
        $cat_desc = $cat_item['cat_description'];
    }
    ?>
    <!-- Hero Search Section Begin -->
    <div class="hero-search set-bg" data-setbg="img/search-bg.jpg">
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

    <!-- Recipe Section Begin -->
    <section class="recipe-section spad">
        <div class="container">
            <h1>@if(isset($cat_id) && $cat_id != "") {{$cat_description}} Posts @else All Posts @endif</h1>
           
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-8">

                     @if(!empty($records))
                    <div class="row">
                    
                        @foreach ($records as $post)
                     
                            <div class="col-md-12">
                                <div class="recipe-item">
                                    <a href="#"><img style="width:100%" src="/storage/image_cover/{{$post->image_cover}}" alt=""></a>
                                    <div class="ri-text">
                                        <div class="cat-name">{{$post->cat_id}}</div>
                                        <a href="/posts/{{$post->id}}">
                                            <h4>{{$post->title}}</h4>
                                        </a>
                                        <p>{{$post->body}}</p>
                                    </div>
                                </div>
                            </div>
                        
                        @endforeach
                    </div> 
                        
                    @endif
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="section-title">
                        <h3>Categories</h3>
                    </div>
                    <br>
                    @if(!empty($categories))
                        <ul style="list-style-type:none">
                            @foreach($categories as $cat)
                                <li><a href="/post/all/{{$cat->id}}"><h5>{{$cat->cat_description}} - ({{$cat_count[$cat->id]}})</h5></li>
                                <br>

                            @endforeach
                         </ul>
                    @endif
                </div>
            </div>
           
        </div>
        <!--   
            <div class="col-lg-4 col-sm-6">
                    <div class="recipe-item">
                        <a href="#"><img src="img/recipe/recipe-2.jpg" alt=""></a>
                        <div class="ri-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Blueberries cake</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="recipe-item">
                        <a href="#"><img src="img/recipe/recipe-3.jpg" alt=""></a>
                        <div class="ri-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Pork Steak with Onion</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="recipe-item">
                        <a href="#"><img src="img/recipe/recipe-4.jpg" alt=""></a>
                        <div class="ri-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Pizza with salami</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="recipe-item">
                        <a href="#"><img src="img/recipe/recipe-5.jpg" alt=""></a>
                        <div class="ri-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Pumpkin Chilli Soup</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="recipe-item">
                        <a href="#"><img src="img/recipe/recipe-6.jpg" alt=""></a>
                        <div class="ri-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Salmon with veggies</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="recipe-item">
                        <a href="#"><img src="img/recipe/recipe-7.jpg" alt=""></a>
                        <div class="ri-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Strawberry Chessecake</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="recipe-item">
                        <a href="#"><img src="img/recipe/recipe-8.jpg" alt=""></a>
                        <div class="ri-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Key Lime Pie</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="recipe-item">
                        <a href="#"><img src="img/recipe/recipe-9.jpg" alt=""></a>
                        <div class="ri-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Pizza with cheesse</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recipe-pagination">
                        <a href="#" class="active">01</a>
                        <a href="#">02</a>
                        <a href="#">03</a>
                        <a href="#">04</a>
                        <a href="#">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- Recipe Section End -->

    <!-- Categories Feature Recipe Section Begin -->
    <!--
    <section class="categories-feature-recipe spad">
        <div class="section-title">
            <h5>Featured Recipes</h5>
        </div>
        <div class="container po-relative">
            <div class="plus-icon">
                <i class="fa fa-plus"></i>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="cfr-item">
                        <div class="cfr-item-img set-bg" data-setbg="img/cat-feature/big-1.jpg">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="cfr-item-text">
                            <div class="cat-name">Vegan</div>
                            <a href="#">
                                <h4>One Pot Weeknight Lasagna Soup Recipe</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="cfr-item">
                        <div class="cfr-item-img set-bg" data-setbg="img/cat-feature/big-2.jpg">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="cfr-item-text">
                            <div class="cat-name">Meat Lover</div>
                            <a href="#">
                                <h4>Veggie soup with Mushrooms</h4>
                            </a>
                            <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                aliqua. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    <div class="cfr-item">
                        <div class="cfr-item-img set-bg" data-setbg="img/cat-feature/big-3.jpg">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="cfr-item-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Caramel Ice Cream with Berries</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="cfr-item">
                        <div class="cfr-item-img set-bg" data-setbg="img/cat-feature/big-4.jpg">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="cfr-item-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Freash Octopuse with lime juice</h4>
                            </a>
                            <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit
                                amet, consectetur adipiscing.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-1.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>One Pot Weeknight Lasagna Soup Recipe</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-2.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Lava Cake with a Tone of Chocolate</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-3.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>One Pot Weeknight Lasagna Soup Recipe</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-4.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Smoked Salmon mini Sandwiches with Onion</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-5.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Asparagus with Pork Loin and Vegetables</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-6.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Dry Cookies with Corn</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-7.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Italian Tiramisu with Coffe</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- Categories Feature Recipe Section End -->
@endsection