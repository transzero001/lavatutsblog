<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use Session;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$posts=Post::all();
        $posts=Post::orderBy('id','desc')->paginate(5);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();


        return view('posts.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body' => 'required'
        ));
        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug=$request->slug;
        $post->save();

        Session::flash('success','The blog post was successfully save!');

        return redirect()->route('posts.show', $post->id);

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $post = Post::find($id);
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate
        $post = Post::find($id);

        if($request->slug==$post->slug){

            $this->validate($request, array(
                'title' => 'required|max:255',
                'body' => 'required'
            ));
        }else{

            $this->validate($request, array(
                'title' => 'required|max:255',
                'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'body' => 'required'
            ));
        }

        //save the data

        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->slug=$request->input('slug');
        $post->save();
        //redirect with flash data
        Session::flash('success','This post was successfully updated');


        //redirect to show with flash data
        return redirect()->route('posts.show',$post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::find($id);
        $post->delete();
        Session::flash('success','The post is successfully deleted');
        return redirect()->route('posts.index');
        //
    }
}
