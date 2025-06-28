<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class TambahPerlombaanPenyelenggara extends Controller
{
     function TambahPerlombaan()
    {
        return Inertia::render('admin/TambahPerlombaanPenyelenggara');
    }
}


