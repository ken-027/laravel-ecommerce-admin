<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand As ModelBrand;

class Brand extends Controller
{
    //
    public function index() {
        return view('admin.content.brand', [
            'table_name' => encrypt(ModelBrand::$table_name)
        ]);
    }

    public function get_list(Request $request) {
        $brand_list = ModelBrand::get_list($request);
        $total_list = ModelBrand::get_total_list($request);
        $data = array();
        foreach ($brand_list as $key => $brand) {
            $id = $brand->id;
            $data[$key] = [
                encrypt($brand->id),
                asset('storage/brand/'. base64_encode($id) . '/' . $brand->image),
                $brand->title,
                $brand->ordering,
                (bool)$brand->published
            ];
        }
        return response()->json([
            // 'draw' => intval($request->draw),
            'data' => $data,
            'recordsTotal' => count($brand_list),
            'recordsFiltered' => count($total_list),
        ]);
    }
    
    public function publish(Request $request) {

        $res = ModelBrand::update_publish($request->id);
        return response()->json(['update' => (bool)$res]);
    }

    public function get_top_band_by_orders() {
        $brand_list = ModelBrand::get_list_by_ordering();
        $data = array();
        foreach ($brand_list as $key => $brand) {
            $data[$key] = [
                encrypt($brand->id),
                $brand->title,
                $brand->ordering,
                (bool)$brand->published
            ];
        }
        $data = array_slice((array)$data, 0, 5);
        array_multisort( array_column($data, 1), SORT_ASC, $data );

        return response()->json(['data' => $data]);
    }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-brandeditform');
        return response()->json([
            'response' => view('admin.layout.forms.brand', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'brand' => $is_edit ? ModelBrand::get_info_by_id(decrypt($request->id)) : [],
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
            'description' => 'required',
            'publish' => 'required',
            // 'icon' => 'nullable|image',
        ], 
        [
            'required' => 'This field is required.'
        ]);
        if($request->file('icon')) $request->validate(['icon' => 'image']);
        if(request()->routeIs('admin-brandupdate')) $request->validate(['id' => 'required']);

        $request->icloudstatus = !empty($request->icloudstatus) ? '1':'0';

        if ($request->file('icon')) {
            $fileName = base64_encode(date('YmdGis'));
            $fileName .= '.' . $request->file('icon')->getClientOriginalExtension();
            $request->icon = $fileName;
            // $path = 'setting/' . base64_encode($request->id) . '/';
        // $request->logo = $path . $fileName;
        }

        // $document->getRealPath();
        // $document->getClientOriginalName();
        // $document->getClientOriginalExtension();
        // $document->getSize();
        // $document->getMimeType();

        if(request()->routeIs('admin-brandadd')) {
            $result = ModelBrand::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelBrand::edit($request);
            $pre_msg = 'Update';
        }
    

        if($result && $request->file()) {
            $id = request()->routeIs('admin-brandadd') ? $result : $request->id;
            $path = 'brand/' . base64_encode($id) . '/';
            $request->file('icon')->storeAs( $path, $fileName, 'public');
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
