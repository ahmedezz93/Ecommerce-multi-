<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $parent_categories=Category::active()->parent()->with(['childs'])->latest()->take(6)->get();
        $products=Product::active()->with('category')->latest()->take(8)->get();
        return view('site.home',compact('parent_categories','products'));
    }
}
