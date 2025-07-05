<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PesertaController extends Controller
{
    public function profile()
    {
        return Inertia::render('ProfilPeserta');
    }

    public function lomba()
    {
        return Inertia::render('LombaPeserta');
    }
}
