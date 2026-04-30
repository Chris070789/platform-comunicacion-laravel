<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Forum;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Forum $forum, Topic $topic)
    {
        // Traer los posts del topic
        $posts = $topic->posts()->latest()->get();

        return view('topics.posts.index', compact('forum', 'topic', 'posts'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Simplemente retornamos la vista con el formulario
        return view('topics.posts.create', compact('forum', 'topic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Forum $forum, Topic $topic)
    {
        $user = Auth::user();

        // Validar solo el campo content
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        // Crear el post asociado al topic y al usuario
        $topic->posts()->create([
            'content' => $data['content'],
            'user_id' => $user->id,
        ]);

        return redirect()->route('topics.posts.index', [$forum, $topic])
            ->with('success', 'Respuesta publicada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic, Post $post)
    {
        return view('topics.posts.show', compact('topic', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
