<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Lomba;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return Inertia::render('Landing');
    }
    public function explore()
    {
        return Inertia::render('Explore');
    }
    public function details($id)
    {
        return Inertia::render('DetailLomba');
    }
}
