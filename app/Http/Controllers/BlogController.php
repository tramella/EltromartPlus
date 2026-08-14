<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //

    public function index()
    {
        $blog = Blog::orderBy('created_at', 'desc')->take(4)->get();
        return view('blogs', compact('blog'));
    }

    public function blog($id)
    {
        $blogdetail = Blog::find($id);
        if (!$blogdetail) {
            return redirect()->back()->with('error', "Blog not found");
        }
        return view("blogdetail", compact('blogdetail'));
    }
}
