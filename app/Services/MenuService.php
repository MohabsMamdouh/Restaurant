<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuService
{
    public function getMenus()
    {
        return Menu::all();
    }

    public function storeMenu($data, $image)
    {
        $menu = Menu::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $image,
        ]);

        $menu->categories()->attach($data['categories']);

        return $menu;
    }

    public function updateMenu(Menu $menu, $data, $image = null)
    {
        if($image == null) {
            $image = $menu->image;
        }

        $menu->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $image
        ]);

        $menu->categories()->sync($data['categories']);

        return $menu;
    }

    public function trashMenu() {
        return Menu::onlyTrashed()->get();
    }

    public function restore($id) {
        return Menu::withTrashed()->find($id)->restore();
    }

    public function forceDelete($id)
    {
        return Menu::withTrashed()->find($id)->forceDelete();
    }

    public function destroy(Menu $menu)
    {
        return $menu->delete();
    }
}
