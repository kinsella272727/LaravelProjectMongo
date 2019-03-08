<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Tag;
use App\Category;
use DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        clock('Test Posts.');
        clock()->startEvent('get-all-posts', "Loading all posts from the database");
        $posts = Post::orderBy('title', 'desc')->get();
        clock()->endEvent('get-all-posts');
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'title' => 'required',
          'body' => 'required',
          'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle file is_uploaded_file
        if($request->hasFile('cover_image')) {
          //Get file name with extension
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
          //Get just file name
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          //get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          //filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          //Upload image
          $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
        } else {
          $fileNameToStore = 'noimage.jpg';
        }

        // Create POST
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;

        $post->save();
        $post->tags()->sync($request->input('tags'));

        return redirect('/posts')->with('success', 'Post Created');

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

        //Check for correct user_id

        if(auth()->user()->id !==$post->user_id){
          return redirect('/posts')->with('error', 'Unauthorized Page');
        }

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
      $this->validate($request, [
        'title' => 'required',
        'body' => 'required'
      ]);

      //Handle file is_uploaded_file
      if($request->hasFile('cover_image')) {
        //Get file name with extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        //Get just file name
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //Upload image
        $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
      }

      // Create POST
      $post = Post::find($id);
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      if($request->hasFile('cover_image')){
        $post->cover_image = $fileNameToStore;
      }
      $post->save();

      return redirect('/posts')->with('success', 'Post Updated');
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
        if(auth()->user()->id !==$post->user_id){
          return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg'){
          //Delete Image
          Storage::delete('public/cover_image/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
