<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Promo extends Model
{
    public static $table_name = 'promocode';

    public static function get_list($filter) {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('promocode', 'LIKE', "%$filter->search%")
        ->offset($filter->input('start'))
        ->limit($filter->input('length'))
        ->get();
    }

    public static function get_total_list($filter) {
        $db = DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->where('promocode', 'LIKE', "%$filter->search%");
        if (!empty($filter->search)) {
            $db->offset($filter->input('start'))
            ->limit($filter->input('length'));
        }
        return $db->get();
    }
    
    public static function insert($request) {
        return DB::table(self::$table_name)
        ->insertGetId([
            'name' => $request->promoname,
            'promocode' => $request->promocode,
            'description' => !empty($request->description) ? $request->description : '',
            'image' => $request->icon,
            'from_date' => format_date_db($request->datefrom),
            'to_date' => format_date_db($request->dateto),
            'never_expire' => $request->neverexpire,
            'discount_type' => $request->discounttype,
            'discount' => $request->discount,
            'multiple_act_by_same_cust' => $request->activationsamecustomer,
            'multi_act_by_same_cust_qty' => $request->activationsamecustomer ? $request->actsamecustomerquantity : 0,
            'act_by_cust' => $request->timescodeactivated,
            'status' => $request->status,
        ]);
    }
    
    public static function edit($request) {
        $get_info = self::get_info_by_id($request->id);

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'name' => $request->promoname,
            'promocode' => $request->promocode,
            'description' => !empty($request->description) ? $request->description : '',
            'image' => $request->icon,
            'from_date' => format_date_db($request->datefrom),
            'to_date' => format_date_db($request->dateto),
            'never_expire' => $request->neverexpire,
            'discount_type' => $request->discounttype,
            'discount' => $request->discount,
            'multiple_act_by_same_cust' => $request->activationsamecustomer,
            'multi_act_by_same_cust_qty' => $request->activationsamecustomer ? $request->actsamecustomerquantity : 0,
            'act_by_cust' => $request->timescodeactivated,
            'status' => $request->status,
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }

    public static function update_status($id) {
        $status = 0;
        // get the current status
        $promo = DB::table(self::$table_name)
        ->select('status')
        ->where('id', '=', $id)
        ->first();

        if(!empty($promo)) $status = $promo->status == 0 ? 1:0;
        
        // change the status
        return DB::table(self::$table_name)
        ->where('id', $id)
        ->update(['status' => $status]);
    }
}
