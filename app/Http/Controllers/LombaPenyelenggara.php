<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Illuminate\Http\Request;
use function Termwind\render;

class LombaPenyelenggara extends Controller
{
    function TambahLomba()
    {
        return Inertia::render('admin/TambahPerlombaan');
       
    }
}
