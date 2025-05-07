<?php

// app/Http/Controllers/EarningController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EarningController extends Controller
{
    public function index()
    {
        return view('earning.index'); // Create this Blade view
    }
}
