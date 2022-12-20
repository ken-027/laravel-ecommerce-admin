<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Deleted as ModelDeleted;

class DeleteRecords extends Controller
{
    //
    public function index(Request $request) {
        $request->validate([
            'name' => 'required',
            'id' => 'required',
        ]);

        return response()->json([
            'is_deleted' => (bool)ModelDeleted::insert(decrypt($request->name), decrypt($request->id))
        ]);
    }

    public function bulk_delete(Request $request) {
        $request->validate([
            'name' => 'required',
            'ids' => 'required',
        ]);

        $bulk_delete = [];
        foreach ($request->ids as $value) {
            $value = (object)$value;
            $bulk_delete[$value->id] = (bool)ModelDeleted::insert(decrypt($request->name), decrypt($value->id));
        }

        return response()->json([
            'is_deleted' => $bulk_delete,
        ]);
    }

    public function restore(Request $request) {
        $request->validate([
            'name' => 'required',
            'id' => 'required',
        ]);

        return response()->json([
            'is_restore' => (bool)ModelDeleted::restore(decrypt($request->name), decrypt($request->id)),
        ]);
    }

    public function bulk_restore(Request $request) {
        $request->validate([
            'name' => 'required',
            'ids' => 'required',
        ]);

        $bulk_delete = [];
        foreach ($request->ids as $value) {
            $value = (object)$value;
            $bulk_delete[$value->id] = (bool)ModelDeleted::restore(decrypt($request->name), decrypt($value->id));
        }

        return response()->json([
            'is_restore' => $bulk_delete,
        ]);
    }
}
