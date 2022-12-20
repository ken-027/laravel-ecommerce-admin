<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Customer extends Model
{
    public static $table_name = 'users';

    public static function get_list($filter) {
        return DB::table(self::$table_name . ' AS u')
        ->leftjoin('orders AS o', 'o.user_id', '=', 'u.id')
        ->leftjoin('user_type AS ut', 'ut.id', '=', 'u.user_type')
        ->select('u.id','email', 'phone', 'u.status', 'ut.type', 'u.date', 'o.order_id', 'u.name', DB::raw('(SELECT COUNT(price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = u.id)'), '=', 0) //check if this is deleted
        ->where(function($query) use ($filter) {
            $query->where('u.email', 'LIKE', '%' . $filter->search . '%')
            ->orWhere('u.phone', 'LIKE', '%' . $filter->search . '%')
            ->orWhere('u.name', 'LIKE', '%' . $filter->search . '%');
        })
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name . ' AS u')
        ->leftjoin('orders AS o', 'o.user_id', '=', 'u.id')
        ->leftjoin('user_type AS ut', 'ut.id', '=', 'u.user_type')
        ->select('u.id','email', 'phone', 'u.status', 'ut.type', 'u.date', 'o.order_id', 'u.name', DB::raw('(SELECT COUNT(price) FROM order_items AS oi WHERE oi.order_id = o.order_id) AS total_orders'))   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = u.id)'), '=', 0) //check if this is deleted
        ->where(function($query) use ($filter) {
            $query->where('u.email', 'LIKE', '%' . $filter->search . '%')
            ->orWhere('u.phone', 'LIKE', '%' . $filter->search . '%')
            ->orWhere('u.name', 'LIKE', '%' . $filter->search . '%');
        });
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }

    public static function update_status($id) {
        $status = 0;
        // get the current status
        $customer = DB::table(self::$table_name)
        ->select('status')
        ->where('id', '=', $id)
        ->first();

        if(!empty($customer)) $status = $customer->status == 0 ? 1:0;
        
        // change the status
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['status' => $status]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }

    public static function edit($request) {
        $request->password = !empty($request->password) ? $request->password : self::get_info_by_id($request->id)->password;

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'company_name' => $request->company,
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => $request->status,
            'address' => $request->addressline,
            'address2' => $request->addressline2,
            'city' => $request->city,
            'password' => $request->password,
            'state' => $request->state,
            'postcode' => $request->postalcode,
            'occasional_special_offers' => $request->sendoccasionaloffer,
            'important_sms_notifications' => $request->sendimportantsms,
        ]);
    }
}
