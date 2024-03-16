<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function getCategories()
    {
        return Category::all();
    }

    public function storeCategory($data, $image)
    {
        return Category::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $image,
        ]);
    }

    public function updateCategory(Category $category, $data, $image = null)
    {
        if($image == null) {
            $image = $category->image;
        }

        $category->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $image
        ]);

        return $category;
    }

    public function trashCategory() {
        return Category::onlyTrashed()->get();
    }

    public function restore($id) {
        return Category::withTrashed()->find($id)->restore();
    }

    public function forceDelete($id)
    {
        return Category::withTrashed()->find($id)->forceDelete();
    }

    public function destroy(Category $category)
    {
        return $category->delete();
    }
}
