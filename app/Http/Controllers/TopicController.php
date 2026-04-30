<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Forum $forum)
    {
        $topics = $forum->topics()->latest()->get();

        // Aquí enviamos $forum y $topics a la vista
        return view('topics.index', compact('forum', 'topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($forumId)
    {
        // Buscamos el foro para asegurarnos de que existe y para usar sus datos en la vista
        $forum = Forum::findOrFail($forumId);

        // Retornamos la vista pasando la variable $forum
        return view('topics.create', compact('forum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Forum $forum)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Asignar manualmente los campos que no vienen del formulario
        $data['user_id'] = $user->id;
        $data['forum_id'] = $forum->id;

        Topic::create($data);
        //dd($data);

        return redirect()->route('forums.topics.index', $forum);
    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum, Topic $topic)
    {
        // Cargamos los posts y sus autores de una sola vez
        $topic->load('posts.user');

        return view('forums.topics.show', compact('forum', 'topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
