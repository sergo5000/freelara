<?php

namespace App\Http\Controllers;

use App\Entity\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $regions = DB::table('regions')->get();

        dd($regions);

        return view('welcome', compact('regions'));
    }



    public function create(Request $request)
    {
       // $categoryId = $request->input('categories');
        
      //  dd(end($categoryId));

         return view('welcome');
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