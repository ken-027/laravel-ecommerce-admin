<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\StarbuckLocation As ModelStarbuckLocation;

class StarbuckLocations extends Controller
{
    //
    public function index() {
        return view('admin.content.starbuck-locations', [
            'table_name' => encrypt(ModelStarbuckLocation::$table_name)
        ]);
    }

    public function get_list(Request $request) {
        $starbucks = ModelStarbuckLocation::get_list($request);
        $total_list = ModelStarbuckLocation::get_total_list($request);
        $data = array();
        foreach ($starbucks as $key => $starbuck) {
            $data[$key] = [
                encrypt($starbuck->id),
                $starbuck->name,
                $starbuck->address,
                $starbuck->ordering,
                (bool)$starbuck->status,
            ];
        }
        return response()->json([
            // 'draw' => intval($request->draw),
            'data' => $data,
            'recordsTotal' => count($starbucks),
            'recordsFiltered' => count($total_list),

        ]);
    }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-starbuckeditform');

        return response()->json([
            'response' => view('admin.layout.forms.starbuck-location', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'starbuck' => $is_edit ? ModelStarbuckLocation::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-starbuckupdate');

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            // 'description' => 'required',
            'googlemaplink' => 'required',
            'publish' => 'required',
        ], ['required' => 'This field is required.']);
        
        if($is_edit) $request->validate(['id' => 'required']);

        if(!$is_edit) {
            $result = ModelStarbuckLocation::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelStarbuckLocation::edit($request);
            $pre_msg = 'Update';
        }
    

        $message = $result ? $pre_msg . ' successfully' : "Failed to $pre_msg!";

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
            ]
        ]);
    }
}
