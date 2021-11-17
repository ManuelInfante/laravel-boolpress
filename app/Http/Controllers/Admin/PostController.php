<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use illuminate\support\Str;

use App\Post;

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
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $form_data = $request->all();
    
        $new_post = new Post();
        $new_post->fill($form_data);

        /*
            Titolo: il mio post
            Slug: il-mio-post
        */
        $slug = Str::slug($new_post->title, '-');

        $slug_presente = Post::where('slug', $slug)->first();

        $contatore = 1;
        while($slug_presente)
        {
            $slug = $slug . '-' . $contatore;
            $slug_presente = Post::where('slug', $slug)->fisrt();
            $contatore++;
        }

        $new_post->slug = $slug;

        $new_post->save();

        return redirect()->route('admin.posts.index')->with('status', 'Il post è stato creato correttamente!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post){
            return view('admin.posts.show', compact('post'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post){
            return view('admin.posts.edit', compact('post'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post){
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        
        $form_data = $request->all();
    
        if ($form_data['title'] != $post->title){
            $slug = Str::slug($form_data['title'], '-');
    
            $slug_presente = Post::where('slug', $slug)->first();
    
            $contatore = 1;
            while($slug_presente)
            {
                $slug = $slug . '-' . $contatore;
                $slug_presente = Post::where('slug', $slug)->fisrt();
                $contatore++;
            }
    
            $form_data['slug'] = $slug;
        }
    
        $post->update($form_data);
    
        return redirect()->route('admin.posts.index')->with('status', 'post correttamente aggiornato');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Post $post
     * @return \Illuminate\Http\Response
     */
            
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Il post è stato eliminato correttamente!');
    }

}
