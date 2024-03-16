<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Models\Category;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends BaseController
{
    private $MenuService;

    public function __construct(MenuService $MenuService) {
        $this->MenuService = $MenuService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = $this->MenuService->getMenus();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuStoreRequest $request)
    {
        $request->validated();

        $image = $request->file('image');

        $imagePath = $this->storeImage($image, 'public/menus', $request['name']);

        $menu = $this->MenuService->storeMenu($request, $imagePath);

        return to_route('admin.menus.index')->with('success', 'Menu Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menus.edit', compact('categories', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuUpdateRequest $request, Menu $menu)
    {
        $request->validated();

        if ($request->hasFile('image')) {
            Storage::delete($menu->image);

            $image = $request->file('image');

            $imagePath = $this->storeImage($image, 'public/menus', $request['name']);

        } else {
            $imagePath = null;
        }

        $menu = $this->MenuService->updateMenu($menu, $request, $imagePath);

        return to_route('admin.menus.index')->with('success', 'Menu Updated Successfully');
    }

    public function trach()
    {
        $menus = $this->MenuService->trashMenu();
        return view('admin.menus.trash',compact('menus'));
    }

    public function restore($id)
    {
        $menu = $this->MenuService->restore($id);

        return to_route('admin.menus.index')->with('success', 'Menu Restored Successfully');
    }

    public function forceDelete($id)
    {
        $this->MenuService->forceDelete($id);

        return to_route('admin.menus.trash')->with('danger', 'Menu Deleted Successfully Forever');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $this->MenuService->destroy($menu);

        return to_route('admin.menus.index')->with('danger', 'Menu Deleted Successfully');
    }
}
