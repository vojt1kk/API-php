<?php

use App\Models\Category;
use App\Http\Controllers\Controller;
 
class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }
}
