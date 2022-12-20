<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin As ModelAdmin;
use App\Models\Admin\StaffGroup As ModelStaffGroup;

class Staffs extends Controller
{
    public function index() {
        return view('admin.content.staffs.index', [
            'table_name' => encrypt(ModelAdmin::$table_name)
        ]);
    }

    public function group() {
        return view('admin.content.staffs.groups', [
            'table_name' => encrypt(ModelStaffGroup::$table_name)
        ]);
    }

    public function get_list(Request $request) {
        $staffs = ModelAdmin::get_list($request);
        $total_list = ModelAdmin::get_total_list($request);

        $data = array();
        foreach ($staffs as $key => $staff) {
            $data[$key] = [
                encrypt($staff->id),
                $staff->username,
                $staff->email,
                $staff->group_name,
                (bool)$staff->status,
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($staffs), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }

    public function get_group_list(Request $request) {
        $staff_groups = ModelStaffGroup::get_list($request);
        $total_list = ModelStaffGroup::get_total_list($request);

        $data = array();
        foreach ($staff_groups as $key => $staff_group) {
            $data[$key] = [
                encrypt($staff_group->id),
                $staff_group->name,
                implode(', ', array_keys((array)get_access_permission(json_decode($staff_group->permissions), false))),
                (bool)$staff_group->status,
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($staff_groups), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-staffeditform');

        return response()->json([
            'response' => view('admin.layout.forms.staff', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'staff_groups' => ModelStaffGroup::get_all(),
                'staff' => $is_edit ? ModelAdmin::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function form_group(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-staffgroupeditform');
        $get_info = $is_edit ? ModelStaffGroup::get_info_by_id(decrypt($request->id)) : [];

        return response()->json([
            'response' => view('admin.layout.forms.staff-group', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'staff_groups' => ModelStaffGroup::get_all(),
                'permissions' => $is_edit ? json_decode($get_info->permissions) : [],
                'staff_group' => $get_info,
                // 'permissions' => $is_edit ? json_decode(ModelAdmin::get_info_by_id(decrypt($request->id))->permissions) : [],
                ])->render()
        ]);
    }

    public function view_permission(Request $request) {
        $request->validate([
            'id' => 'required'
        ]);

        return response()->json([
            'response' => view('admin.layout.forms.staff-group.view-permission', [
                'permissions' => get_access_permission(json_decode(ModelStaffGroup::get_info_by_id(decrypt($request->id))->permissions), false),
            ])->render(),
            // 'data' => get_access_permission(json_decode(ModelStaffGroup::get_info_by_id(decrypt($request->id))->permissions), false),
        ]);
    } 

    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-staffupdate');

        $request->validate([
            'username' => 'required',
            'email' => 'required|email',            // 'group' => 'required',
            'status' => 'required',
        ], [ 'required' => 'This field is required.' ]);

        if($is_edit) 
            $request->validate(['id' => 'required']);
        else
            $request->validate(['password' => 'required']);

        // $document->getRealPath();
        // $document->getClientOriginalName();
        // $document->getClientOriginalExtension();
        // $document->getSize();
        // $document->getMimeType();

        $request->group = decrypt($request->group);

        if(!$is_edit) {
            $result = ModelAdmin::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelAdmin::edit($request);
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

    public function save_group(Request $request) {
        $is_edit = request()->routeIs('admin-staffgroupupdate');

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'status' => 'required',
        ], [ 'required' => 'This field is required.' ]);


        if($is_edit) 
            $request->validate(['id' => 'required']);

        $request->permissions = get_access_permission(json_decode($request->permissions)->permission); 

        if(!$is_edit) {
            $result = ModelStaffGroup::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelStaffGroup::edit($request);
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

    public function update_status(Request $request) {
        return response()->json([
            'update' => (bool)ModelAdmin::update_status(decrypt($request->id)) 
        ]);
    }
}
