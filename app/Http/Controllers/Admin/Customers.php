<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Customer As ModelCustomer;

class Customers extends Controller
{
    public function index() {
        return view('admin.content.customers', [
            'table_name' => encrypt(ModelCustomer::$table_name)
        ]);
    }

    public function get_list(Request $request) {

        $customers = ModelCustomer::get_list($request);
        $total_list = ModelCustomer::get_total_list($request);

        $data = array();
        foreach ($customers as $key => $customer) {
            $data[$key] = [
                encrypt($customer->id),
                $customer->name,
                $customer->email,
                $customer->phone,
                $customer->total_orders,
                $customer->type,
                date_format(date_create($customer->date), 'M/d/Y'),
                (bool)$customer->status,
                $customer->order_id,
            ];
        }
        return response()->json([
            // 'draw' => intval($request->draw),
            'data' => $data,
            'recordsTotal' => count($customers),
            'recordsFiltered' => count($total_list),
        ]);
    }

    public function form(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-customereditform');
        return response()->json([
            'response' => view('admin.layout.forms.customer', [
                ///for editing
                'is_edit' => $is_edit,
                'id' => $is_edit ? $request->id : 0,
                'customer' => $is_edit ? ModelCustomer::get_info_by_id(decrypt($request->id)) : [],
            ])->render()
        ]);
    }

    public function update_status(Request $request) {
        return response()->json([
            'update' => (bool)ModelCustomer::update_status(decrypt($request->id)) 
        ]);
    }

    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-customerupdate');

        $request->validate([
            'company' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'addressline' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postalcode' => 'required',
        ], [ 'required' => 'This field is required.' ]);

        if($is_edit) $request->validate(['id' => 'required']);

        $request->sendoccasionaloffer = !empty($request->sendoccasionaloffer) ? '1':'0';
        $request->sendimportantsms = !empty($request->sendimportantsms) ? '1':'0';
        $request->password = !empty($request->password) ? Hash::make($request->password) : ''; 

        if(!$is_edit) {
            //ADD here!
        }
        else {
            $request->id = decrypt($request->id);
            $result = ModelCustomer::edit($request);
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
