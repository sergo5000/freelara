<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    public function index()
    {
        $regions = DB::table('regions')->get();



        return view('region', compact('regions'));
    }

    public function json()
    {
        $regions = DB::table('regions')->get();



        return view('region', compact('regions'));
    }

    public function create(Request $request)
    {
        dd($request->all());

        return view('region');
    }
}