<?php

namespace App\Http\Controllers;

use App\Entity\Category;
use App\Entity\Attribute;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::defaultOrder()->withDepth()->get()->toTree();
        $attributes = Attribute::orderBy('category_id')->orderBy('sort')->get();

        $categoriesArray = $this->categoriesToArray($categories);
        $attributesArray = $this->attributesToArray($attributes);

        // Категория с атрибутами
        $category = Category::find(301);

        return view('welcome', compact('categoriesArray', 'attributesArray', 'category'));
    }



    public function create(Request $request)
    {
        dd($request->all());

        $categoryId = $request->input('categories');
        

        // return view('welcome', compact('categories', 'categoriesArray'));
    }

    protected function categoriesToArray($categories)
    {
        $categoriesArray = [];
        foreach($categories as $category) {
            $categoriesArray[$category->id] = [
                'name' => $category->name,
                'children' => $this->categoriesToArray($category->children),
            ];
        }

        return $categoriesArray;
    }

    protected function attributesToArray($attributes)
    {
        $category_id = null;
        $attributesArray = [];
        $currentArray = null;

        foreach($attributes as $attribute) {
            if($attribute->category_id != $category_id) {
                if($category_id) {
                    $attributesArray[$category_id] = $currentArray;
                }

                $category_id = $attribute->category_id;
                $currentArray = [];
            }

            $currentArray[] = [
                'id' => $attribute->id,
                'category_id' => $attribute->category_id,
                'name' => $attribute->name,
                'type' => $attribute->type,
                'required' => $attribute->required,
                'variants' => $attribute->variants,
            ];
        }

        if($category_id) {
            $attributesArray[$category_id] = $currentArray;
        }

        return $attributesArray;
    }
}