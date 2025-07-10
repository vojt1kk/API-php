<?php
namespace App\Http\Controllers\Api;


use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
 
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10); // nebo libovolný počet na stránku
        return CategoryResource::collection($categories);
    }

    public function show(Category $category) 
    {
        return new CategoryResource($category);
    } 

    public function list()
    {
        return CategoryResource::collection(Category::all());
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
 
        return new CategoryResource($category);
    }
}
