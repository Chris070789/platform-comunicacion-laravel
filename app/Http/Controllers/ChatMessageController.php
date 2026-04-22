<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatGroup;
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;

class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $chatGroup = ChatGroup::findOrFail($request->chat_group_id);
        $message = $chatGroup->messages()->create([
            'user_id' => $user->id(),
            'message' => $request->message,
        ]);

        // broadcast(new NewChatMessage($chatGroup->id, $message->message, $user))->toOthers();

        return response()->json(['status' => 'ok']);
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
