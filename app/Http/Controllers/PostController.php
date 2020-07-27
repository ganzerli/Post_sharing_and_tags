<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
       // dd($posts);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        // create one post in db
        $post = Auth::user()->posts()->create($request->validated());

        //to post present in db is attachable the relation
        foreach ($request->input() as $input) {
            $TagSameInputName = Tag::where('name',$input)->get()->first();
            // check for existence in tag table
            if($TagSameInputName){
               $post->tags()->attach($TagSameInputName->id);
            }
        }

        return redirect()->back()->with('message','Il post é stato inserito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('posts.edit',compact('post','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPost $request, Post $post)
    {
        //dd($request->validated());
        
        
        $post->update($request->validated());

        $postTags = [];
        //to post present in db is attachable the relation
        foreach ($request->input() as $input) {
            $TagSameInputName = Tag::where('name',$input)->get()->first();
            // check for existence in tag table
            if($TagSameInputName){
               array_push($postTags,$TagSameInputName->id);
            }
        }
       // dd($postTags);
        $post->tags()->sync($postTags);

        return redirect()->back()->with('message','Il post é stato modificato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }

    public function tagIndex(Tag $tag){
        //dd($tag->posts);
        return view('posts.tags', ['posts'=>$tag->posts , 'tag'=>$tag ]);
    }
}
