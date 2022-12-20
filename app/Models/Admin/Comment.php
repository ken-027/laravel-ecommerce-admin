<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{
    public static $table_name = 'comments';


    public static function get_list($order_id) {
        return DB::table(self::$table_name . ' AS c')
        ->leftjoin('admin AS a', 'a.id', '=', 'c.staff_id')
        ->select('c.*', 'a.name', 'a.username')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = c.id)'), '=', 0) //check if this is deleted
        ->where('c.order_id', $order_id)
        ->orderBy('date', 'DESC')
        ->get();
    }

    public static function insert($request) {
        return DB::table(self::$table_name)
        ->insertGetId([
            'staff_id' => $request->staff,
            'order_id' => $request->orderid,
            'comment' => $request->comment,
            'date' => date('Y-m-d G:i:s'),
            'status' => $request->status,
        ]);
    }
    
    public static function edit($request) {
        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'staff_id' => $request->staff,
            'order_id' => $request->orderid,
            'comment' => $request->comment,
            'date' => date('Y-m-d G:i:s'),
            'status' => $request->status,
        ]);
    }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }
}
