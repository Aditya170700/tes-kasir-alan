<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        return Inertia::render('Food/Index');
    }

    public function create()
    {
        return Inertia::render('Food/Create');
    }

    public function store(Request $request)
    {
        //
    }
}
