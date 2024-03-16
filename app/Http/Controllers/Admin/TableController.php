<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableStoreRequest;
use App\Http\Requests\TableUpdateRequest;
use App\Models\Table;
use App\Services\TableService;
use Illuminate\Http\Request;

class TableController extends Controller
{
    private $TableService;

    public function __construct(TableService $TableService) {
        $this->TableService = $TableService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = $this->TableService->getTables();
        return view('admin.tables.index',  compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TableStoreRequest $request)
    {
        $table = $this->TableService->storeTable($request->validated());

        return to_route('admin.tables.index')->with('success', 'Table Created Successfully');
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
    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TableUpdateRequest $request, Table $table)
    {
        $table = $this->TableService->updateTable($table, $request->validated());

        return to_route('admin.tables.index')->with('success', 'Table Updated Successfully');
    }

    public function trach()
    {
        $tables = $this->TableService->trashTable();
        return view('admin.tables.trash',compact('tables'));
    }

    public function restore($id)
    {
        $table = $this->TableService->restore($id);

        return to_route('admin.tables.index')->with('success', 'Table Restored Successfully');
    }

    public function forceDelete($id)
    {
        $this->TableService->forceDelete($id);

        return to_route('admin.tables.trash')->with('danger', 'Table Deleted Successfully Forever');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        $this->TableService->destroy($table);

        return to_route('admin.tables.index')->with('danger', 'Table Deleted Successfully');
    }
}
