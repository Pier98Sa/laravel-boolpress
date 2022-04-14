<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return view('admin.posts.index', compact('posts'));
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
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:5',
                'author' => 'required|min:3',
                'category_id' =>'nullable|exists:categories,id',
                'content' => 'required|min::10',
                'tags' => 'nullable|exists:tags,id',
                'image' => 'nullable|mimes:jpg,jpeg,png,bmp|max:2048'
            ]
        );

        $data = $request->all();

        if(isset($data['image'])){
            $cover_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_path; 
        }
        //creazione dello slug 
        $slug = Str::of($data['title'])->slug('-');

        $counter = 1;
        while(Post::where('slug', $slug)->first()){

            $slug = Str::of($data['title'])->slug('-') .'-'. $counter;
            $counter++;
        }

        $data['slug'] = $slug;

        $post = new Post();
        $post->fill($data);
        $post->save();

        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories= Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => 'required|min:5',
                'author' => 'required|min:3',
                'category_id' =>'nullable|exists:categories,id',
                'content' => 'required|min::10',
                'tags' => 'nullable|exists:tags,id',
                'image' => 'nullable|mimes:jpg,jpeg,png,bmp|max:2048'
            ]
        );

        $data = $request->all();

        if(isset($data['image'])){

            if($post->cover){
                Storage::delete($post->cover); 
            }

            $cover_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_path; 
        }

        //creazione dello slug 
        $slug = Str::of($data['title'])->slug('-');

        if($post->slug != $slug){
            $counter = 1;

            while(Post::where('slug', $slug)->first()){

                $slug = Str::of($data['title'])->slug('-') .'-'. $counter;
                $counter++;
            }

            $data['slug'] = $slug;
        }

        $post->update($data);
        $post->save();
        
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->cover) {
            Storage::delete($post->cover);
        }
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
