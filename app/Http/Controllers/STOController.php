<?php
// filepath: /d:/STO-master/STO-master/app/Http/Controllers/STOController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import the User model

class STOController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('sto.index', compact('user'));
    }

    public function showForm()
    {
        $user = Auth::user();
        return view('STO.from', compact('user'));
    }

    public function manage(Request $request, $id)
    {
        // Your manage logic here
    }
}   