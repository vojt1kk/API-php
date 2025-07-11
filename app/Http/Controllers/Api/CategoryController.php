<?php
namespace App\Http\Controllers\Api\V1; 


use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\QueryParam;

/**
 * @group Categories
 *
 * Managing Categories
 */
#[Group('Categories', 'Managing Categories')]
class CategoryController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/categories",
    *     summary="Seznam kategorií",
    *     tags={"Categories"},
    *     @OA\Response(
    *         response=200,
    *         description="OK"
    *     )
    * )
    */
    #[Endpoint('Get Categories', <<<DESC
        Getting the list of the categories
    DESC)]
    #[QueryParam('page', 'int', 'Which page to show.', example: 12)]
    public function index()
    { 
        return CategoryResource::collection(Category::all());
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
