<?php

namespace App\Http\Controllers;

use App\Entity\Category;
use App\Entity\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::defaultOrder()->withDepth()->get()->toTree();
        $attributes = Attribute::orderBy('category_id')->orderBy('sort')->get();

        $categoriesArray = $this->categoriesToArray($categories);
        $attributesArray = $this->attributesToArray($attributes);

        return view('welcome', compact('categoriesArray', 'attributesArray'));
    }

    public function create(Request $request)
    {
        $categoryIds = $request->get('categories');
        $selectedCategoryId = end($categoryIds);

        $enteredAttributes = $request->get('attributes');

        if ($selectedCategoryId) {
            $request->session()->flash('selectedCategoryId', $selectedCategoryId);
        }

        if ($enteredAttributes) {
            $request->session()->flash('enteredAttributes', $enteredAttributes);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required',
            'categories' => 'present|array',
            'attributes' => 'present|array',
        ]);

        if ($validator->fails()) {
            return redirect()->route('welcome')->withErrors($validator)->withInput();
        }

        $request->session()->flush();

        return redirect()->route('welcome')->with('success', 'Создание прошло успешно');
    }

    private function categoriesToArray($categories)
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

    private function attributesToArray($attributes)
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