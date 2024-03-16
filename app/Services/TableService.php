<?php

namespace App\Services;

use App\Models\Table;

class TableService
{
    public function getTables()
    {
        return Table::all();
    }

    public function getTable(Table $table)
    {
        return $table;
    }

    public function storeTable($data)
    {
        return Table::create([
            'name' => $data['name'],
            'guest_number' => $data['guest_number'],
            'status' => $data['status'],
            'location' => $data['location'],
        ]);
    }

    public function updateTable(Table $table, $data)
    {
        $table->update([
            'name' => $data['name'],
            'guest_number' => $data['guest_number'],
            'status' => $data['status'],
            'location' => $data['location'],
        ]);

        return $table;
    }

    public function trashTable() {
        return Table::onlyTrashed()->get();
    }

    public function restore($id) {
        return Table::withTrashed()->find($id)->restore();
    }

    public function forceDelete($id)
    {
        return Table::withTrashed()->find($id)->forceDelete();
    }

    public function destroy(Table $table)
    {
        return $table->delete();
    }
}
