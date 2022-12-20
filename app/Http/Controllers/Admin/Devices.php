<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Device As ModelDevice;

class Devices extends Controller
{
    public function index() {
        return view('admin.content.devices',[
            'table_name' => encrypt(ModelDevice::$table_name)
        ]);
    }

    public function get_list(Request $request) {
        // $response = [
        //     'status' => 1,
        //     'data' => view('admin.layout.tables.category', ['categories' => ModelCategory::get_list($request)])->render(),
        // ];
        $devices = ModelDevice::get_list($request);
        $total_list = ModelDevice::get_total_list($request);
        $data = array();
        foreach ($devices as $key => $device) {
            $data[$key] = [
                encrypt($device->id),
                asset('storage/devices/' . base64_encode($device->id) . '/' .$device->device_img),
                $device->title,
                $device->ordering,
                (bool)$device->published
            ];
        }
        return response()->json([
            // 'draw' => intval($request->draw),
            'data' => $data,
            'recordsTotal' => count($devices),
            'recordsFiltered' => count($total_list),
        ]);
    }

    // public function add(Request $request) {
    //     return response()->json([
    //         'response' => view('admin.layout.forms.devices.add')->render()
    //     ]);
    // }

    // public function edit(Request $request) {
    //     return response()->json([
    //         'response' => view('admin.layout.forms.devices.edit', [
    //                 'device' => ModelDevice::get_info_by_id(decrypt($request->id)),
    //         ])->render(),
    //     ]);
    // }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-deviceseditform');
        return response()->json([
            'response' => view('admin.layout.forms.devices', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'device' => $is_edit ? ModelDevice::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function save(Request $request) {
        $request->validate([
            'title' => 'required',
            'sefurl' => 'required',
            'metatitle' => 'required',
            'metadescription' => 'required',
            'metakeywords' => 'required',
            // 'description' => 'required',
            'publish' => 'required',
            // 'icon' => 'nullable|image',
        ], 
        [
            'required' => 'This field is required.'
        ]);

        if($request->file('devicepicture')) $request->validate(['devicepicture' => 'image']);
        if(request()->routeIs('admin-deviceupdate')) $request->validate(['id' => 'required']);

        $request->isdevicepopular = !empty($request->isdevicepopular) ? '1':'0';

        if ($request->file('devicepicture')) {
            $fileName = base64_encode($request->file('devicepicture')->getClientOriginalName());
            $fileName .= '.' . $request->file('devicepicture')->getClientOriginalExtension();
            $request->devicepicture = $fileName;
            // $path = 'setting/' . base64_encode($request->id) . '/';
        // $request->logo = $path . $fileName;
        }

        // $document->getRealPath();
        // $document->getClientOriginalName();
        // $document->getClientOriginalExtension();
        // $document->getSize();
        // $document->getMimeType();

        if(request()->routeIs('admin-deviceadd')) {
            $result = ModelDevice::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelDevice::edit($request);
            $pre_msg = 'Update';
        }
    

        if($result && $request->file()) {
            $id = request()->routeIs('admin-deviceadd') ? $result : $request->id;
            $path = 'devices/' . base64_encode($id) . '/';
            $request->file('devicepicture')->storeAs( $path, $fileName, 'public');
        }

        $message = $result ? $pre_msg . ' successfully' : "Failed to $pre_msg!";

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
                'icon' => $request->file('icon')
            ]
        ]);
    }
}
