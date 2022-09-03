<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $posts = Post::latest()->paginate(5);

        //render view with posts
        return view('posts.index', compact('posts'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'name'     => 'required|min:5',
            'jenis'     => 'required|min:5',
            'ras'     => 'required|min:5',
            'usia'     => 'required|min:5',
            'harga'     => 'required|min:5'
        ]);


        //create post
        Post::create([
            'name'      => $request->name,
            'jenis'      => $request->jenis,
            'ras'      => $request->ras,
            'usia'      => $request->usia,
            'harga'      => $request->harga
        ]);

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * edit
     *
     * @param  mixed $post
     * @return void
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Post $post)
    {
        //validate form
        $this->validate($request, [
            'name'     => 'required|min:5',
            'jenis'     => 'required|min:5',
            'ras'     => 'required|min:5',
            'usia'     => 'required|min:5',
            'harga'     => 'required|min:5'
        ]);

        $post::update([
            'name'      => $request->name,
            'jenis'      => $request->jenis,
            'ras'      => $request->ras,
            'usia'      => $request->usia,
            'harga'      => $request->harga
        ]);

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Post $post)
    {
        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}