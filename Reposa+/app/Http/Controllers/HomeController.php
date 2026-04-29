<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        $featuredProducts = \App\Models\Product::take(4)->get();
        
        return view('home', compact('categories', 'featuredProducts'));
    }
}
