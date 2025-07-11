<?php
namespace App\Http\Controllers\Api;


use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

 
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

    public function store(StoreCategoryRequest $request) 
    {
        $data = $request->validated();
        $category = Category::create($data);
        if (isset($data['photo'])) { 
            $file = $data['photo'];
            $name = 'categories/' . Str::uuid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $data['photo'] = $name;
        } 

        return new CategoryResource($category);
    }

    public function update(Category $category, StoreCategoryRequest $request)
    {
        $category->update($request->validated());
 
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
 
        return response()->noContent(); 
    }
}
