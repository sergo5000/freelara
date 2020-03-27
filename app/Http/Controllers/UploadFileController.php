<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function add(Request $request)
    {

        dd($request->all());

    }
}
