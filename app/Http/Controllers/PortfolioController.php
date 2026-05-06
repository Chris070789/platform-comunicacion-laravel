<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PortfolioController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::where('user_id', Auth::id())->get();
        return view('portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portfolios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->authorize('create', Portfolio::class);
        // 1. Validar los datos
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048', // 2MB max
        ]);

        $data = $request->all();

        // 2. Manejar la subida del archivo
        if ($request->hasFile('file')) {
            // Guarda el archivo en storage/app/public/portfolios
            $path = $request->file('file')->store('portfolios', 'public');
            $data['file_path'] = $path;
        }

        // 3. Asignar el user_id del usuario logueado
        $data['user_id'] = $user->id;

        // 4. Crear el registro
        Portfolio::create($data);

        return redirect()->route('portfolios.index')->with('success', 'Portafolio creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        $this->authorize('view', $portfolio);
        return view('portfolios.show', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        // Autorización opcional si usas Policies
        $this->authorize('update', $portfolio);

        return view('portfolios.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $this->authorize('update', $portfolio);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $portfolio->update($request->only('title', 'description'));

        return redirect()
            ->route('portfolios.show', $portfolio->id)
            ->with('success', 'Portafolio actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $this->authorize('delete', $portfolio);

        $portfolio->delete();

        return redirect()
            ->route('portfolios.index')
            ->with('success', 'Portafolio eliminado correctamente.');
    }
}
