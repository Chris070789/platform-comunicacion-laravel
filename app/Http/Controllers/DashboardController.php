<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;

class DashboardController extends Controller
{
    public function index()
    {
        // Traer todos los stages, o filtrados según el rol
        $stages = Stage::all();

        return view('dashboard', compact('stages'));
    }
}
