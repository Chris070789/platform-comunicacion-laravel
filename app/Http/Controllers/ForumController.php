<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = Forum::all();
        return view('forums.index', compact('forums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Crear el foro y asignar el docente creador
        $forum = Forum::create([
            'title' => $validated['title'],
            'user_id' => $user->id, // opcional si quieres guardar el creador
        ]);


        // Redirigir al index de topics dentro de ese foro
        return redirect()->route('forums.topics.index', $forum)
            ->with('success', 'Foro creado correctamente. Ahora puedes crear temas.');
    }

    /**
     * Display the specified resource.
     */
    // En ForumController.php
    public function show(Forum $forum)
    {
        // Cargamos los temas de este foro
        $topics = $forum->topics;

        return view('forums.show', compact('forum', 'topics'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
