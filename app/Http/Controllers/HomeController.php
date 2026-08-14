<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brands;

class HomeController extends Controller
{
    //
    public function index()
    {
        $categories = (new CategoryController)->getCategories();

        $brands = (new BrandController)->getBrands();

        $saleProducts = (new ProductController)->getTopSale();
        $topMobile = (new ProductController)->getTopMobile();
        $newProduct = (new ProductController)->newProduct();
        $topLaptop = (new ProductController)->getTopLaptop();
        

        // Trả về view với dữ liệu từ cả 2 controller
        return view('homepage', compact('categories', 'brands', 'saleProducts', 'topMobile', 'newProduct', 'topLaptop'));
    }
}
