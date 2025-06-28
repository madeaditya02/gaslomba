<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class ListPeserta extends Controller
{
    function listPeserta()
    {
        return Inertia::render('peserta/ListPeserta');
    }
}
