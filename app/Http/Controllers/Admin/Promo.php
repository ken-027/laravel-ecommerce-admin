<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Promo as ModelPromo;
use App\Models\Admin\GeneralSetting as ModelGeneralSetting;

class Promo extends Controller
{
    public function index() {
        return view('admin.content.promo', [
            'table_name' => encrypt(ModelPromo::$table_name)
        ]);
    }


    public function get_list(Request $request) {
        $promo_list = ModelPromo::get_list($request);
        $total_list = ModelPromo::get_total_list($request);

        $data = array();
        foreach ($promo_list as $key => $promo) {
            $data[$key] = [
                encrypt($promo->id),
                $promo->promocode,
                format_date_table($promo->from_date),
                format_date_table($promo->to_date),
                $promo->discount_type == 'percentage' ? $promo->discount . '%' : $promo->discount,  
                (bool)$promo->status, 
                $key + 1 + intval($request->input('start')),
            ];
        }

        return response()->json([
            //'draw' => intval(draw)
            'data' => $data, //data list
            'recordsTotal' => count($promo_list), //fetch list
            'recordsFiltered' => count($total_list) //total list,
        ], 200);
    }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-promoeditform');

        return response()->json([
            'response' => view('admin.layout.forms.promo', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'currency' => explode(',', ModelGeneralSetting::get_list()->currency)[1],
                'promo' => $is_edit ? ModelPromo::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-promoupdate');

        $request->validate([
            'promoname' => 'required',
            'promocode' => 'required',
            // 'description' => 'required',
            'status' => 'required',
            'datefrom' => 'required|date',
            'dateto' => 'required|date',
            'discounttype' => 'required',
            'discount' => 'required|numeric',
            'timescodeactivated' => 'required|numeric',
            // 'icon' => 'nullable|image',
        ], ['required' => 'This field is required.']);
        
        if($request->file('icon')) $request->validate(['icon' => 'image']);
        if($is_edit) $request->validate(['id' => 'required']);
        if (!empty($request->activationsamecustomer)) $request->validate(['actsamecustomerquantity' => 'required|numeric'], ['required' => 'This field is required.']);

        $request->neverexpire = !empty($request->neverexpire) ? '1':'0';
        $request->activationsamecustomer = !empty($request->activationsamecustomer) ? '1':'0';


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

        if(!$is_edit) {
            $result = ModelPromo::insert($request);
            $pre_msg = 'Save';
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelPromo::edit($request);
            $pre_msg = 'Update';
        }
    

        if($result && $request->file()) {
            $id = !$is_edit ? $result : $request->id;
            $path = 'promo/' . base64_encode($id) . '/';
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

    public function update_status(Request $request) {
        return response()->json([
            'update' => (bool)ModelPromo::update_status(decrypt($request->id)) 
        ]);
    }
}
