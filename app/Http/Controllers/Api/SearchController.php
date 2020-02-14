<?php

namespace App\Http\Controllers\Api;

use App\Entity\Region;
use Illuminate\Support\Facades\Input;

class SearchController
{
    public function index()
    {
        $query = Input::get('query');
        $regions = Region::where('name','like','%'.$query.'%')->get();


        return response()->json($regions);

    }
}