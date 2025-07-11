<?php

namespace App\Http\Controllers\Api\V1; 
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Group;

/**
 * @group Products
 *
 * Managing Products
 */
#[Group('Products', 'Managing Products')]
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(9); 

        return ProductResource::collection($products); 
    }
}
