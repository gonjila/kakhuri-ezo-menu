<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    function index () {
        return Inertia::render('AllDishes', ["products" => Product::all()]);
    }

    function get($productName){
        return Inertia::render('SingleProduct', ['productName' => $productName]);
    }

}
