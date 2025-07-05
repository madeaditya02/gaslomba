<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class ProfilPenyelenggara extends Controller
{
    function Profil()
    {
        return Inertia::render('admin/ProfilPenyelenggara');
    }
}
 
