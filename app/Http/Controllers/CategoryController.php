<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function getCategories()
    {
        return Categories::take(8)->get();
        // return view('homepage', compact('categories'));
    }
}
