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
            'user_id' => $user->id(), // docente creador
        ]);
        return redirect()->route('chat-groups.index');
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
