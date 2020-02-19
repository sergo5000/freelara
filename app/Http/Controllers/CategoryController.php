<?php

namespace App\Http\Controllers;

use App\Entity\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::defaultOrder()->withDepth()->get()->toTree();
        $categoriesArray = $this->toArray($categories);


        // Категория с атрибутами
        $category = Category::find(301);


        return view('welcome', compact('categories', 'categoriesArray', 'category'));
    }



    public function create(Request $request)
    {
        dd($request->all());

        $categoryId = $request->input('categories');
        

        // return view('welcome', compact('categories', 'categoriesArray'));
    }

    protected function toArray($categories)
    {
        $categoriesArray = [];
        foreach($categories as $category) {
            $categoriesArray[$category->id] = [
                'name' => $category->name,
                'children' => $this->toArray($category->children),
            ];
        }

        return $categoriesArray;
    }
}