<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatGroup;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;
use Illuminate\Support\Facades\Log;

class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChatGroup $chatGroup)
    {
        $chatGroup = ChatGroup::with('messages.user')->findOrFail($chatGroup->id);
        $groups = ChatGroup::all(); // o lo que quieras mostrar
        $messages = $chatGroup->messages()->with('user')->get();


        return view('chat.index', compact('chatGroup', 'groups', 'messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ChatGroup $chatGroup)
    {
        $chatGroup = ChatGroup::findOrFail($chatGroup->id);
        return view('chat.create', compact('chatGroup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ChatGroup $chatGroup)
    {
        // dd($request->all());
        $user = Auth::user();
        // Validación estricta
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        // Crear mensaje vinculado al grupo y usuario
        $message = $chatGroup->messages()->create([
            'user_id' => $user->id,
            'message' => $validated['message'],
        ]);

        // Respuesta clara en JSON
        return response()->json([
            'status' => 'ok',
            'message' => $message,
            'user' => ['id' => $user->id], // Solo datos esenciales del usuario
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
