<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditPerlombaanPenyelenggara extends Controller
{
    function EditPerlombaan()
    {
        return inertia('admin/EditPerlombaanPenyelenggara');
    }
}
