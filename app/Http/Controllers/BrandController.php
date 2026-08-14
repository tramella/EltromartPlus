<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brands;

class BrandController extends Controller
{
    //
    public function getBrands()
    {
        return Brands::take(5)->get();
        // return view('homepage', compact('brands'));
    }
}
