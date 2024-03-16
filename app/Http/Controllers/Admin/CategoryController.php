<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Storage;

class CategoryController extends BaseController
{
    private $CategoryService;


    public function __construct(CategoryService $CategoryService) {
        $this->CategoryService = $CategoryService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->CategoryService->getCategories();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $request->validated();

        $image = $request->file('image');

        $imagePath = $this->storeImage($image, 'public/categories', $request['name']);

        $category = $this->CategoryService->storeCategory($request, $imagePath);

        return to_route('admin.categories.index')->with('success', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $request->validated();

        if ($request->hasFile('image')) {
            Storage::delete($category->image);

            $image = $request->file('image');

            $imagePath = $this->storeImage($image, 'public/categories', $request['name']);

        } else {
            $imagePath = null;
        }

        $category = $this->CategoryService->updateCategory($category, $request, $imagePath);


        return to_route('admin.categories.index')->with('success', 'Category Updated Successfully');
    }

    public function trach()
    {
        $categories = $this->CategoryService->trashCategory();
        return view('admin.categories.trash',compact('categories'));
    }

    public function restore($id)
    {
        $category = $this->CategoryService->restore($id);

        return to_route('admin.categories.index')->with('success', 'Category Restored Successfully');
    }

    public function forceDelete($id)
    {
        $this->CategoryService->forceDelete($id);

        return to_route('admin.categories.trash')->with('danger', 'Category Deleted Successfully Forever');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->CategoryService->destroy($category);

        return to_route('admin.categories.index')->with('danger', 'Category Deleted Successfully');
    }
}
