<?php

namespace App\Http\Controllers;

use App\Entity\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::defaultOrder()->withDepth()->get()->toTree();

        //dd($categories);

        return view('welcome', compact('categories'));
    }
}