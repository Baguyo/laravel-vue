<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        return inertia('Index/Index', 
        [
            'message' => 'This is from controller',
        ]);

        // dd(Auth::user());
    }

    public function show()
    {
        return inertia('Index/Show');
    }
}
