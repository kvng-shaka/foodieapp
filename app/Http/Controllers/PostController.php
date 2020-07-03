<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facade\Storage;
use Illuminate\Http\Facade\Input;
use Illuminate\Http\Facade\Auth;
use App\Post;
use App\User;
use DB;
use App\Category;

class PostController extends Controller
{   
    public function __construct()
    {
        $show_items = array('index','show','cat_posts');//Show  these methods without auth
        $this->middleware('auth',['except' => $show_items]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_recs = Post::orderBy('created_at','desc')->paginate(3);
        //return view('posts.index')->with('posts', $posts);

        $count = array();
       
        /*$all_recs = DB::select("select * from posts where 1=1 ORDER BY updated_at DESC");*/
        


        //Getting posts by Each Category
        $all_news               = Post::where("cat_id", "=", "1")->get();
        $all_politics           = Post::where("cat_id", "=", "2")->get();
        $all_lifestyle          = Post::where("cat_id", "=", "3")->get();
        $all_entertainment      = Post::where("cat_id", "=", "4")->get();
        $all_sports             = Post::where("cat_id", "=", "5")->get();


        $count['1']          =   count($all_news);
        $count['2']          =   count($all_politics);
        $count['3']          =   count($all_lifestyle);
        $count['4']          =   count($all_entertainment);
        $count['5']          =   count($all_sports);


        $all_cats = Category::all();
        //dd($all_recs);
        
        //dd($all_cats);
        //dd($count);
        return view('posts.index')->with("records", $all_recs)->with('categories', $all_cats)
        ->with("cat_count",$count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.createpost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image_cover' => 'image|nullable|max:1999', 
        ]);

        //Handle file upload
        if($request->hasFile('image_cover')){
            //Get Filename With the Extension
            $filenameWithExt = $request->file('image_cover')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->file('image_cover')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload Image
            $path = $request->file('image_cover')->storeAs('public/image_cover', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }


        //dd($request->all());
        $savePost = new Post();
        //dd($savePost);
        $savePost->title            = $request->title;
        $savePost->body             = $request->body;
        $savePost->user_id          = Auth()->user()->id;
        $savePost->cat_id           = $request->cat_description;
        $savePost->image_cover      = $fileNameToStore;
        $savePost->save();
         
        if($savePost){
            return redirect('/posts')->with("success","Post created succesfully");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

         //Handle file upload
         if($request->hasFile('image_cover')){
            //Get Filename With the Extension
            $filenameWithExt = $request->file('image_cover')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->file('image_cover')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload Image
            $path = $request->file('image_cover')->storeAs('public/image_cover', $fileNameToStore);
        }

        //dd($request->all());
        $savePost = Post::find($id);
        //dd($savePost);
        $savePost->title = $request['title'];
        $savePost->body  = $request['body'];
        if($request->hasFile('image_cover')){
            $savePost->image_cover = $fileNameToStore;
        }
        $savePost->save();
         
        if($savePost){
            return redirect("/posts")->with("success","Post Updated succesfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //Check for correct user
        if(Auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($savePost->image_cover != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/image_cover/'.$savePost->image_cover);
        }

        $post->delete();
        return redirect("/posts")->with("success","Post Deleted succesfully");
    }



    public function cat_posts($cat_id = null)
    {
       // dd($cat_id);
        $count = array();
        if($cat_id != null){
            $all_recs = DB::select("select * from posts where cat_id = '$cat_id' order by updated_at DESC");
        }
        /*else{
            $all_recs = DB::select("select * from posts where cat_description !='' oreder by updated_at DESC");
        }*/


        //Getting posts by Each Category
        $all_news               = Post::where("cat_id", "=", "1")->get();
        $all_politics           = Post::where("cat_id", "=", "2")->get();
        $all_lifestyle          = Post::where("cat_id", "=", "3")->get();
        $all_entertainment      = Post::where("cat_id", "=", "4")->get();
        $all_sports             = Post::where("cat_id", "=", "5")->get();


        $count['1']          =   count($all_news);
        $count['2']          =   count($all_politics);
        $count['3']          =   count($all_lifestyle);
        $count['4']          =   count($all_entertainment);
        $count['5']          =   count($all_sports);


        $all_cats = Category::all();
        return view('posts.index')->with("records", $all_recs)->with('categories', $all_cats)
        ->with("cat_count",$count)->with("cat_id", $cat_name);
    }
}
