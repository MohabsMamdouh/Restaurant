<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;


class CategoryController extends Controller
{

    private $CategoryService;


    public function __construct(CategoryService $CategoryService) {
        $this->CategoryService = $CategoryService;
    }


    public function index()
    {
        $categories = $this->CategoryService->getCategories();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }
}
