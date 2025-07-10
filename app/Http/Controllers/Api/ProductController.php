<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(9); 

        return ProductResource::collection($products); 
    }
}
