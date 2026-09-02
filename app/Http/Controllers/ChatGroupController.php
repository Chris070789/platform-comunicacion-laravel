<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatGroup;
use Illuminate\Support\Facades\Auth;

class ChatGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = ChatGroup::all();
        return view('chat.index', compact('groups'));
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
        ChatGroup::create([
            'name' => $request->name,
            'user_id' => $user->id, // docente creador
        ]);
        return redirect()->route('chat-groups.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatGroup $chatGroup)
    {
        // Carga el grupo con sus mensajes
        $chatGroup->load('messages.user');

        return view('chat.show', compact('chatGroup'));
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
        /** @var \App\Models\User $user */
        $user = Auth::user();
        // 1. Buscar la sala de chat o lanzar error 404 si no existe
        $chatGroup = ChatGroup::findOrFail($id);

        // 2. (Opcional) Verificar que el usuario autenticado sea el creador
        if ($chatGroup->user_id !== $user->id) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar esta sala.');
        }

        // 3. Eliminar mensajes asociados primero (si no tienes ON DELETE CASCADE en la BD)
        $chatGroup->messages()->delete();

        // 4. Eliminar la sala de chat
        $chatGroup->delete();

        // 5. Redireccionar con mensaje de éxito
        return redirect()->route('chat-groups.index')
            ->with('success', 'Sala de chat eliminada correctamente.');
    }
}
